<?php

namespace App\Http\Resources;

use App\Enums\MeetingStatus;
use App\Helpers\ArrHelper;
use App\Helpers\CalHelper;
use App\Helpers\SysHelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingSummary extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type = ArrHelper::searchByKey(ArrHelper::getTransList('types', 'meeting'), 'uuid', $this->type);

        return [
           'uuid'        => $this->uuid,
           'title'       => $this->title,
           'agenda'      => $this->agenda,
           'type'        => $type,
           'is_paid'     => $this->is_paid,
           'has_event'   => (bool) $this->getMeta('has_event'),
           'event_uuid'  => $this->getMeta('event_uuid'),
           'fee'         => $this->when($this->is_paid, SysHelper::formatCurrency($this->getFee('amount'))),
           'category'    => new Option($this->whenLoaded('category')),
           'description' => $this->description,
           'created_at'  => CalHelper::toDateTime($this->created_at),
           'updated_at'  => CalHelper::toDateTime($this->updated_at)
        ];
    }
}
