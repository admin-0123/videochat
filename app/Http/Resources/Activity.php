<?php

namespace App\Http\Resources;

use App\Helpers\CalHelper;
use App\Http\Resources\UserSummary;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class Activity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'description' => trans('global.'.$this->description, ['attribute' => trans('activity.logs.'. $this->log_name)]),
           'properties'  => $this->properties,
           'info'        => $this->getExtraProperty('info'),
           'causer'      => $this->causer_id ? new UserSummary($this->causer) : null,
           'created_at'  => CalHelper::toDateTime($this->created_at),
           'updated_at'  => CalHelper::toDateTime($this->updated_at),
       ];
    }
}
