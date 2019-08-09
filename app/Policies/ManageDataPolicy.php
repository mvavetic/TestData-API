<?php

namespace App\Policies;

use App\Models\User;

class ManageDataPolicy
{
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
     * Determine if the given user can manage data.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function manage(User $user)
    {
        return $user->manage == 1 ? true : false;
    }
}
