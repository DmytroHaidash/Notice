<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return response()->json(new UserResource($user));
    }

    public function update(Request $request, User $user)
    {
        UserRepository::update($request, $user);
        return response()->json('status', 200);
    }
}
