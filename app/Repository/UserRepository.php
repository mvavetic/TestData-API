<?php

namespace App\Repository;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\HashManager;

class UserRepository
{
    /**
     * Create a new user in the database.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        $user = new User();

        $user->email    = $data['email'];
        $user->name     = $data['name'];
        $user->password = $data['password'];

        $user->save();

        return $user;
    }
}