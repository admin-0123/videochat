<?php

namespace App\Http\Resources;

use App\Helpers\ArrHelper;
use App\Helpers\CalHelper;
use App\Helpers\ListHelper;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Membership extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $currency = ListHelper::getCurrencyByName($this->currency);
        $frequency = ArrHelper::searchByKey(ArrHelper::getTransList('frequencies', 'plan'), 'uuid', $this->frequency ?? '');

        return [
           'uuid'            => $this->uuid,
           'user'            => new UserResource($this->whenLoaded('user')),
           'prefix'          => $this->prefix,
           'number'          => $this->number,
           'amount'          => $this->amount,
           'frequency'       => $frequency,
           'currency'        => $currency,
           'start_date'      => CalHelper::toDate($this->start_date),
           'expiry_date'     => CalHelper::toDate($this->expiry_date),
           'status'          => $this->status ? true : false,
           'lifetime'        => $this->getMeta('lifetime') ? true : false,
           'payment_gateway' => $this->payment_gateway,
           'billing_address' => $this->billing_address,
           'plan_charge'     => (float) ($this->getMeta('plan_charge') ? : $this->amount),
           'created_at'      => CalHelper::toDateTime($this->created_at),
           'updated_at'      => CalHelper::toDateTime($this->updated_at)
        ];
    }
}
