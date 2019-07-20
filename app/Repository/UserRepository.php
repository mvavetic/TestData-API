<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    /**
     * Create a new user in the database.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data) : User
    {
        $user = new User();

        $user->email    = $data['email'];
        $user->name     = $data['name'];
        $user->password = $data['password'];

        $user->save();

        return $user;
    }

    public function findByEmail(string $email) : User
    {
        $user = new User();

        $user->where('email', $email)->first();

        return $user;
    }
}