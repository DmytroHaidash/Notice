<?php


namespace App\Services;


use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    public static function update(Request $request, User $user)
    {
        UserRepository::update($request, $user);
        if($request->filled('image')){
            $user->clearMediaCollection('avatar');
            $user->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('avatar');
        }
        return $user;
    }
}