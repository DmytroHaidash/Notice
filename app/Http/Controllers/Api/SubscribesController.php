<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\User;
use App\Repository\SubscribesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscribesController extends Controller
{
    public function store(User $user){
        SubscribesRepository::create($user);
        return response()->json('status',  200);
    }

    public function destroy(User $user)
    {
        SubscribesRepository::destroy($user);
        return response()->json('status',  200);
    }
}
