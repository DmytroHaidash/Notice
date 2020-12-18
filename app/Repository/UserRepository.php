<?php

namespace App\Repository;


use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    public static function update(Request $request, User $user)
    {
        $user->update($request->only('first_name', 'last_name', 'about', 'email', 'longitude', 'latitude'));

        return $user;
    }
}