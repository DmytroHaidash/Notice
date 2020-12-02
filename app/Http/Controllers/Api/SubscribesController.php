<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscribesController extends Controller
{
    public function store(User $user){
        $user->subscribes()->create();
        return response()->json('status',  200);
    }

    public function destroy(User $user)
    {
        $user->subscribe->delete();
        return response()->json('status',  200);
    }
}
