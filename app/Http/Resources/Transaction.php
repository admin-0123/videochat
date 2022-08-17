<?php

namespace App\Http\Resources;

use App\Helpers\CalHelper;
use App\Helpers\ListHelper;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
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

        return [
           'uuid'            => $this->uuid,
           'user'            => new UserResource($this->whenLoaded('user')),
           'prefix'          => $this->prefix,
           'number'          => $this->number,
           'currency'        => $currency,
           'amount'          => $this->amount,
           'status'          => $this->status ? true : false,
           'payment_gateway' => $this->payment_gateway,
           'billing_address' => $this->billing_address,
           'date'            => CalHelper::toDate($this->date),
           'created_at'      => CalHelper::toDateTime($this->created_at),
           'updated_at'      => CalHelper::toDateTime($this->updated_at)
        ];
    }
}
