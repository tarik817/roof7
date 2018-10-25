<?php

namespace App\Http\Repositories;


use App\User;

class UserRepository
{

    public function findByEmailOrCreate($userData)
    {
        if ($user = User::where('email', $userData->email)->first()) {
            return $user;
        }

        return User::create([
            'name' => $userData->name,
            'email' => $userData->email,
        ]);
    }
}
