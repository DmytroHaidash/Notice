<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return response()->json(new UserResource($user));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only('first_name', 'last_name', 'about', 'email', 'longitude', 'latitude'));

        if($request->filled('image')){
            $user->clearMediaCollection('avatar');
            $user->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('avatar');
        }
    }
}
