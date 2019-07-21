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

        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->password = $data['password'];

        $user->save();

        return $user;
    }

    /**
     * Find user by email.
     *
     * @param  string $email
     * @return \App\Models\User
     */
    public function findByEmail(string $email)
    {
        $user = new User();

        $thisUser = $user->where('email', $email)->first();

        return $thisUser;
    }
}