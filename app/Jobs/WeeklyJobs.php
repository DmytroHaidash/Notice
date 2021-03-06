<?php

namespace App\Jobs;

use App\Mail\WeeklyNews;
use App\Models\Advertisement;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WeeklyJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * WeeklyJobs constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subscribers = Subscribe::get();
        $advertisements = Advertisement::latest()->take(5);
        foreach ($subscribers as $subscriber){
            Mail::send(new WeeklyNews($subscriber->user, $advertisements));
        }
    }
}
