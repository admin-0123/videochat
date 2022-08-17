<?php

namespace App\Repositories;

use App\Helpers\ArrHelper;
use App\Helpers\ListHelper;
use App\Helpers\SysHelper;
use App\Http\Resources\TransactionCollection;
use App\Models\Meeting;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class MeetingPaymentRepository
{
    protected $transaction;
    protected $payment;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(
        Transaction $transaction,
        PaymentRepository $payment
    ) {
        $this->transaction = $transaction;
        $this->payment = $payment;
    }

    /**
     * Find payment
     */
    public function findOrFail(Meeting $meeting, $uuid) : Transaction
    {
        $query = $this->transaction->with('user')->whereHasMorph(
            'transactionable',
            [Meeting::class],
            function (Builder $query) use ($meeting) {
                $query->whereId($meeting->id);
            }
        )->whereStatus(1);

        if (! \Auth::user()->hasRole('admin')) {
            $query->whereUserId(\Auth::id());
        }

        $transaction = $query->whereUuid($uuid)->first();

        if (! $transaction) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_input')]);
        }

        return $transaction;
    }

    /**
     * Paginate all payments
     */
    public function paginate(Meeting $meeting) : TransactionCollection
    {
        $sort_by      = $this->transaction->getSortBy();
        $order        = $this->transaction->getOrder();
        $per_page     = $this->transaction->getPerPage();
        $current_page = $this->transaction->getCurrentPage();

        $query = $this->transaction->with('user')->whereHasMorph(
            'transactionable',
            [Meeting::class],
            function (Builder $query) use ($meeting) {
                $query->whereId($meeting->id);
            }
        )->whereStatus(1);

        if (! \Auth::user()->hasRole('admin')) {
            $query->whereUserId(\Auth::id());
        }

        $transactions = $query->orderBy($sort_by, $order)->paginate((int) $per_page, ['*'], 'current_page');

        return new TransactionCollection($transactions);
    }

    /**
     * Get payment pre requisite
     */
    public function getPreRequisite() : array
    {
        $system_currencies = ArrHelper::getVar('currencies');
        $selected_currency = ArrHelper::searchByKey($system_currencies, 'name', config('config.system.currency'));

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

        return compact('payment_gateways', 'selected_currency');
    }

    /**
     * Get payment receipt
     *
     * @param Meeting $meeting
     * @return void
     */
    public function receipt(Meeting $meeting) : Transaction
    {
        $transaction = $this->transaction->with('user')->whereHasMorph(
            'transactionable',
            [Meeting::class],
            function (Builder $query) use ($meeting) {
                $query->whereId($meeting->id);
            }
        )->whereStatus(1)->whereUserId(\Auth::id())->first();

        if (! $transaction) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_input')]);
        }

        return $transaction;
    }

    /**
     * Calculate payable amount
     */
    public function calculate(Meeting $meeting) : array
    {
        $this->validateInput($meeting);

        $payable = SysHelper::formatCurrency($meeting->getFee('amount'));
        $amount = $payable;

        $title = $meeting->title.' '.trans('meeting.props.fee');
        $paddle_url = $this->generatePaddleLink(compact('title', 'payable'));

        return compact('amount', 'payable', 'paddle_url');
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
            'title'             => Arr::get($params, 'title'),
            'webhook_url'       => url('/paddle-payment'),
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
    private function validateInput(Meeting $meeting) : void
    {
        if (! $meeting->is_paid) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }

        if ($meeting->has_paid) {
            throw ValidationException::withMessages(['message' => trans('meeting.payment.fee_already_paid')]);
        }

        if (request('currency.name') != config('config.system.currency')) {
            throw ValidationException::withMessages(['message' => trans('meeting.payment.invalid_currency')]);
        }
    }

    /**
     * Make meeting payment
     */
    public function payment(Meeting $meeting) : void
    {
        $method = request('method', 'stripe');

        $params = $this->calculate($meeting);
        $amount = Arr::get($params, 'amount', 0);
        $payable = Arr::get($params, 'payable', 0);

        $transaction = $this->initPayment(array(
            'amount'     => $amount,
            'payable'    => $payable,
            'meeting_id' => $meeting->id
        ));

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

                $this->completePayment($transaction, $charge->id);

            } catch (\Exception $e) {
                $this->failPayment($transaction, $e->getMessage());

                throw ValidationException::withMessages(['message' => $e->getMessage()]);
            }
        } else if ($method == 'paddle' && config('config.payment_gateway.enable_paddle')) {

            $paddle_domain = config('config.payment_gateway.paddle_mode') ? 'https://checkout.paddle.com' : 'https://sandbox-checkout.paddle.com';

            $token = Arr::get(request('token'), 'id');
            $paddle_checkout_link_url = $paddle_domain . '/api/1.0/order?checkout_id=' . $token;

            $response = Http::get($paddle_checkout_link_url);

            $response = json_decode($response, true);

            if (in_array(Arr::get($response, 'state'), ['processed', 'processing'])) {
                $this->completePayment($transaction, $token);
            } else {
                $this->failPayment($transaction, trans('general.invalid_input'));

                throw ValidationException::withMessages(['message' => trans('general.could_not_complete_request')]);
            }
        } else if ($method == 'paypal' && config('config.payment_gateway.enable_paypal')) {
            $is_valid = $this->payment->validatePaypalPayment(request('token.id'));

            if (! $is_valid) {
                $this->failPayment($transaction, 'Unauthorized');

                throw ValidationException::withMessages(['message' => trans('general.could_not_complete_request')]);
            }

            $this->completePayment($transaction, request('token.id'));
        } else if ($method == 'flutterwave' && config('config.payment_gateway.enable_flutterwave')) {
            $transaction_id = request('meta.transaction_id');

            config([
                'flutterwave.publicKey' => config('config.payment_gateway.flutterwave_key'),
                'flutterwave.secretKey' => config('config.payment_gateway.flutterwave_secret'),
                'flutterwave.secretHash' => config('config.payment_gateway.flutterwave_encryption'),
            ]);

            $response = Flutterwave::verifyTransaction($transaction_id);

            $params = $this->calculate($meeting);
            $amount = Arr::get($params, 'amount', 0);
            $payable = Arr::get($params, 'payable', 0);

            $transaction = $this->initPayment(array(
                'amount'     => $amount,
                'payable'    => $payable,
                'meeting_id' => $meeting->id
            ));

            if (Arr::get($response, 'status') == 'success') {
                $this->completePayment($transaction, $transaction_id);
            } else {
                $this->failPayment($transaction, 'Unknown error!');
                throw ValidationException::withMessages(['message' => 'Unknown error!']);
            }
        } else {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }
    }

    /**
     * Init transaction
     *
     * @param array $params
     */
    private function initPayment($params = array()) : Transaction
    {
        return $this->transaction->forceCreate([
            'uuid'                 => (string) Str::uuid(),
            'user_id'              => \Auth::id(),
            'amount'               => Arr::get($params, 'payable', 0),
            'currency'             => Arr::get(request('currency'), 'name'),
            'status'               => 0,
            'date'                 => today(),
            'transactionable_type' => 'Meeting',
            'transactionable_id'   => Arr::get($params, 'meeting_id'),
            'billing_address'      => array(
                'user_name'     => request('user_name'),
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
     * Complete payment
     *
     * @param Transaction $transaction
     * @param string $reference_number
     */
    private function completePayment(Transaction $transaction, $reference_number) : void
    {
        $transaction_number = $this->transaction->max('number');

        $transaction->number = $transaction_number ? ($transaction_number + 1) : 1;
        $transaction->status = 1;
        $payment_gateway = $transaction->payment_gateway;
        $payment_gateway['reference_number'] = $reference_number;
        $payment_gateway['is_online'] = true;
        $transaction->payment_gateway = $payment_gateway;
        $transaction->save();
    }

    /**
     * Fail payment
     *
     * @param Transaction $transaction
     * @param string $failed_message
     */
    private function failPayment(Transaction $transaction, $failed_message) : void
    {
        $payment_gateway = $transaction->payment_gateway;
        $payment_gateway['failed_message'] = $failed_message;
        $transaction->payment_gateway = $payment_gateway;
        $transaction->save();
    }
}
