<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\ArrHelper;
use App\Helpers\CalHelper;
use App\Helpers\ListHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\MembershipCollection;
use App\Models\Membership;
use App\Repositories\PaymentRepository;
use Illuminate\Support\Facades\Http;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class MembershipRepository
{
    protected $membership;
    protected $payment;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Membership $membership,
        PaymentRepository $payment
    ) {
        $this->membership = $membership;
        $this->payment = $payment;
    }

    /**
     * Find membership
     */
    public function findOrFail($uuid) : Membership
    {
        $query = $this->membership->with('user')->whereStatus(1);

        if (! \Auth::user()->hasRole('admin')) {
            $query->whereUserId(\Auth::id());
        }

        $membership = $query->whereUuid($uuid)->first();

        if (! $membership) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_input')]);
        }

        return $membership;
    }

    /**
     * Paginate all memberships
     */
    public function paginate() : MembershipCollection
    {
        $sort_by      = $this->membership->getSortBy();
        $order        = $this->membership->getOrder();
        $per_page     = $this->membership->getPerPage();
        $current_page = $this->membership->getCurrentPage();

        $query = $this->membership->with('user')->whereStatus(1);

        if (! \Auth::user()->hasRole('admin')) {
            $query->whereUserId(\Auth::id());
        }

        $memberships = $query->orderBy($sort_by, $order)->paginate((int) $per_page, ['*'], 'current_page');

        return new MembershipCollection($memberships);
    }

    /**
     * Get meeting pre requisite
     */
    public function getPreRequisite() : array
    {
        $frequencies    = ArrHelper::getAdvTransList('frequencies', 'plan', config('config.membership.enable_lifetime_membership', false) ? [] : ['lifetime'], false);

        $system_currencies = ArrHelper::getVar('currencies');
        $selected_currency = ArrHelper::searchByKey($system_currencies, 'name', config('config.system.currency'));
        $selected_frequency = ArrHelper::searchByKey($frequencies, 'uuid', 'monthly');

        $new_membership = \Auth::user()->memberships->where('status', 1)->count() ? false : true;

        $payment_gateways = [];
        if (config('config.payment_gateway.enable_stripe')) {
            $payment_gateways[] = array(
                'name'  => 'stripe',
                'label' => 'Stripe',
                'mode'  => (bool) config('config.payment_gateway.stripe_mode'),
                'key'   => config('config.payment_gateway.stripe_key'),
            );
        }
        if (config('config.payment_gateway.enable_paypal')) {
            $payment_gateways[] = array(
                'name'  => 'paypal',
                'label' => 'Paypal',
                'mode'  => (bool) config('config.payment_gateway.paypal_mode'),
                'key'   => config('config.payment_gateway.paypal_key'),
            );
        }
        if (config('config.payment_gateway.enable_paddle')) {
            $payment_gateways[] = array(
                'name'  => 'paddle',
                'label' => 'Paddle',
                'mode'  => (bool) config('config.payment_gateway.paddle_mode'),
                'key'   => config('config.payment_gateway.paddle_key'),
            );
        }
        if (config('config.payment_gateway.enable_flutterwave')) {
            $payment_gateways[] = array(
                'name'  => 'flutterwave',
                'label' => 'Flutterwave',
                'mode'  => (bool) config('config.payment_gateway.flutterwave_mode'),
                'key'   => config('config.payment_gateway.flutterwave_key'),
            );
        }

        return compact('frequencies', 'payment_gateways', 'selected_currency', 'selected_frequency', 'new_membership');
    }

    /**
     * Calculate payable amount
     */
    public function calculate() : array
    {
        $this->validateInput();

        $existing_memberships = (\Auth::user()->memberships->where('status', 1)->count() && \Auth::user()->membership_expiry_date);
        // $start_date = $existing_memberships ? \Auth::user()->membership_expiry_date->toDateString() : today()->toDateString();

        if ($existing_memberships && \Auth::user()->membership_expiry_date->toDateString() <= today()) {
            $start_date = today()->toDateString();
        } else if ($existing_memberships && \Auth::user()->membership_expiry_date->toDateString() > today()) {
            $start_date = \Auth::user()->membership_expiry_date->toDateString();
        } else {
            $start_date = today()->toDateString();
        }

        $applicable_date = $start_date;

        $frequency = Arr::get(request('frequency'), 'uuid');

        $lifetime = false;
        if ($frequency === 'lifetime') {
            $amount = config('config.membership.lifetime_charge');
            $expiry_date = $existing_memberships ? \Auth::user()->membership_expiry_date->toDateString() : null;
            $new_expiry_date = null;
            $lifetime = true;
        } else {
            $period          = ($frequency === 'monthly') ? 1 : 12;
            $amount          = config('config.membership.' . $frequency . '_charge');
            $expiry_date     = $existing_memberships ? \Auth::user()->membership_expiry_date->toDateString() : null;
            $new_expiry_date = Carbon::parse($start_date)->addMonth($period)->toDateString();
        }

        $payable = $amount;

        $paddle_url = $this->generatePaddleLink(compact('frequency', 'payable'));

        return compact('start_date', 'expiry_date', 'amount', 'payable', 'applicable_date', 'new_expiry_date', 'lifetime', 'paddle_url');
    }

    /**
     * General paddle payment link
     *
     * @param array $params
     */
    private function generatePaddleLink($params = array()) : ?string
    {
        if (! config('config.payment_gateway.enable_paddle')) {
            return null;
        }

        $method = request('method', 'stripe');

        if ($method != 'paddle') {
            return null;
        }

        $paddle_domain = config('config.payment_gateway.paddle_mode') ? 'https://vendors.paddle.com' : 'https://sandbox-vendors.paddle.com';

        $paddle_generate_link_url = $paddle_domain . '/api/2.0/product/generate_pay_link';

        $response = Http::post($paddle_generate_link_url, array(
            'vendor_id'         => config('config.payment_gateway.paddle_key'),
            'vendor_auth_code'  => config('config.payment_gateway.paddle_secret'),
            'title'             => config('config.basic.app_name') . ' - ' . Arr::get($params, 'frequency'),
            'webhook_url'       => url('/paddle-membership'),
            'prices'            => [ config('config.system.currency') . ':' . Arr::get($params, 'payable') ],
            'quantity'          => 1,
            'quantity_variable' => 0,
            'passthrough'       => json_encode(array(
                "user_id"    => \Auth::user()->uuid,
                "user_email" => \Auth::user()->email
            ))
        ));

        $response = json_decode($response, true);

        return Arr::get($response, 'success') ? Arr::get($response, 'response.url') : null;
    }

    /**
     * Validate input
     */
    private function validateInput() : void
    {
        if (! in_array(request('frequency.uuid'), ArrHelper::getList('frequencies', 'plan'))) {
            throw ValidationException::withMessages(['message' => trans('membership.invalid_frequency')]);
        }

        if (request('frequency.uuid') === 'lifetime' && ! config('config.membership.enable_lifetime_membership')) {
            throw ValidationException::withMessages(['message' => trans('membership.invalid_frequency')]);
        }

        if (request('currency.name') != config('config.system.currency')) {
            throw ValidationException::withMessages(['message' => trans('membership.invalid_currency')]);
        }

        if (\Auth::user()->has_lifetime_membership) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }
    }

    /**
     * Make membership payment
     */
    public function payment() : void
    {
        $method = request('method', 'stripe');

        $params = $this->calculate();
        $amount = Arr::get($params, 'amount', 0);
        $payable = Arr::get($params, 'payable', 0);

        $membership = $this->initMembership(array(
            'amount'      => $amount,
            'payable'     => $payable,
            'start_date'  => Arr::get($params, 'start_date'),
            'expiry_date' => Arr::get($params, 'new_expiry_date'),
        ));

        if (Arr::get($params, 'lifetime')) {
            $meta = $membership->meta;
            $meta['lifetime'] = true;
            $membership->meta = $meta;
            $membership->save();
        }

        if ($method == 'stripe' && config('config.payment_gateway.enable_stripe')) {
            \Stripe\Stripe::setApiKey(config('config.payment_gateway.stripe_secret'));

            $currency_detail = ListHelper::getCurrencyByName(request('currency.name'), 'name');
            $stripe_factor = Arr::get($currency_detail, 'stripe_factor', 100);

            try {
                $charge = \Stripe\Charge::create([
                    'amount'   => $payable * $stripe_factor,
                    'currency' => Arr::get(request('currency'), 'name'),
                    'source'   => Arr::get(request('token'), 'id')
                ]);

                $this->completeMembership($membership, $charge->id);

            } catch (\Exception $e) {
                $this->failMembership($membership, $e->getMessage());

                throw ValidationException::withMessages(['message' => $e->getMessage()]);
            }
        } else if ($method == 'paddle' && config('config.payment_gateway.enable_paddle')) {

            $paddle_domain = config('config.payment_gateway.paddle_mode') ? 'https://checkout.paddle.com' : 'https://sandbox-checkout.paddle.com';

            $token = Arr::get(request('token'), 'id');
            $paddle_checkout_link_url = $paddle_domain . '/api/1.0/order?checkout_id=' . $token;

            $response = Http::get($paddle_checkout_link_url);

            $response = json_decode($response, true);

            if (in_array(Arr::get($response, 'state'), ['processed', 'processing'])) {
                $this->completeMembership($membership, $token);
            } else {
                $this->failMembership($membership, trans('general.invalid_input'));

                throw ValidationException::withMessages(['message' => trans('general.could_not_complete_request')]);
            }
        } else if ($method == 'paypal' && config('config.payment_gateway.enable_paypal')) {
            $is_valid = $this->payment->validatePaypalPayment(request('token.id'));

            if (! $is_valid) {
                $this->failMembership($membership, 'Unauthorized');

                throw ValidationException::withMessages(['message' => trans('membership.issue_with_payment_gateway')]);
            }

            $this->completeMembership($membership, request('token.id'));
        } else if ($method == 'flutterwave' && config('config.payment_gateway.enable_flutterwave')) {
            $transaction_id = request('meta.transaction_id');

            config([
                'flutterwave.publicKey' => config('config.payment_gateway.flutterwave_key'),
                'flutterwave.secretKey' => config('config.payment_gateway.flutterwave_secret'),
                'flutterwave.secretHash' => config('config.payment_gateway.flutterwave_encryption'),
            ]);

            $response = Flutterwave::verifyTransaction($transaction_id);

            if (Arr::get($response, 'status') == 'success') {
                $this->completeMembership($membership, $transaction_id);
            } else {
                $this->failMembership($membership, 'Unknown error!');

                throw ValidationException::withMessages(['message' => 'Unknown error!']);
            }
        } else {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }
    }

    /**
     * Init membership
     *
     * @param array $params
     */
    private function initMembership($params = array()) : Membership
    {
        return $this->membership->forceCreate([
            'uuid'            => Str::uuid(),
            'user_id'         => \Auth::id(),
            'amount'          => Arr::get($params, 'payable', 0),
            'currency'        => Arr::get(request('currency'), 'name'),
            'frequency'       => Arr::get(request('frequency'), 'uuid'),
            'start_date'      => Arr::get($params, 'start_date'),
            'expiry_date'     => Arr::get($params, 'expiry_date'),
            'status'          => 0,
            'billing_address' => array(
                'address_line1' => request('address_line1'),
                'address_line2' => request('address_line2'),
                'city'          => request('city'),
                'state'         => request('state'),
                'zipcode'       => request('zipcode'),
                'country'       => request('country'),
            ),
            'payment_gateway' => array(
                'source' => request('method')
            ),
            'meta' => array()
        ]);
    }

    /**
     * Complete membership
     *
     * @param Membership $membership
     * @param string $reference_number
     */
    private function completeMembership(Membership $membership, $reference_number) : void
    {
        $membership_number = $this->membership->max('number');

        $membership->number = $membership_number ? ($membership_number + 1) : 1;
        $membership->status = 1;
        $payment_gateway = $membership->payment_gateway;
        $payment_gateway['reference_number'] = $reference_number;
        $payment_gateway['is_online'] = true;
        $membership->payment_gateway = $payment_gateway;
        $membership->save();

        $user = \Auth::user();
        $user->membership_expiry_date = $membership->expiry_date;
        $meta = $user->meta;
        $meta['frequency'] = $membership->frequency;
        $meta['currency'] = $membership->currency;
        $meta['lifetime'] = (bool) $membership->getMeta('lifetime');
        $user->meta = $meta;
        $user->save();
    }

    /**
     * Fail membership
     *
     * @param Membership $membership
     * @param string $failed_message
     */
    private function failMembership(Membership $membership, $failed_message) : void
    {
        $payment_gateway = $membership->payment_gateway;
        $payment_gateway['failed_message'] = $failed_message;
        $membership->payment_gateway = $payment_gateway;
        $membership->save();
    }
}
