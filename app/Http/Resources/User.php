<?php

namespace App\Http\Resources;

use App\Helpers\ArrHelper;
use App\Helpers\CalHelper;
use App\Http\Resources\Config\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $gender = ArrHelper::searchByKey(ArrHelper::getTransList('genders'), 'uuid', $this->gender ?? 'male');

        return [
           'uuid'         => $this->uuid,
           'username'     => $this->username,
           'email'        => $this->email,
           'enable_login' => $this->status != 'activated' ? false : true,
           'status'       => $this->status,
           'is_premium'   => $this->is_premium,
           'profile'      => array(
               'name'       => $this->name,
               'avatar'     => $this->avatar,
               'cover'      => $this->getMeta('cover_image'),
               'gender'     => $gender,
               'birth_date' => CalHelper::toDate($this->birth_date),
               'age'        => CalHelper::getAge($this->birth_date)
           ),
           'membership_expiry_date'  => CalHelper::toDate($this->membership_expiry_date),
           'has_active_membership'   => $this->hasActiveMembership(),
           'has_lifetime_membership' => $this->getMeta('lifetime') ? true : false,
           'timezone'                => $this->timezone,
           'preference'              => $this->user_preference,
           'role'                    => $this->when($this->whenLoaded('roles'), new Role($this->roles()->first())),
           'is_admin'                => $this->hasRole('admin') ? true : false,
           'created_at'              => CalHelper::toDateTime($this->created_at),
           'updated_at'              => CalHelper::toDateTime($this->updated_at)
        ];
    }
}
