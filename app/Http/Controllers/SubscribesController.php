<?php

namespace App\Http\Controllers;

use App\Jobs\WeeklyJobs;
use App\Models\User;
use App\Repository\SubscribesRepository;
use Illuminate\Http\Request;

class SubscribesController extends Controller
{
    public function destroy(User $user)
    {
        SubscribesRepository::destroy($user);
        return view('unsubscribe');
    }
}
