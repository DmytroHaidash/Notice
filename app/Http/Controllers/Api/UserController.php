<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\UserRepository;
use App\Services\UserService;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return response()->json(new UserResource($user));
    }

    public function update(UsersRequest $request, User $user)
    {
        UserService::update($request, $user);
        return response()->json('ok', 200);
    }
}
