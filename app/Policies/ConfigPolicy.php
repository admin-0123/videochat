<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can store config
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Config\Config  $config
     * @return boolean
     */
    public function create(User $user)
    {
        if (request('type') == 'ui') {
            return $user->can('access-ui-config');
        } else if (request('type') == 'meeting') {
            return $user->can('access-meeting-config');
        }

        return $user->can('access-config');
    }
}
