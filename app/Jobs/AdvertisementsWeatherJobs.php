<?php

namespace App\Jobs;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AdvertisementsWeatherJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
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
        $advertisements = Advertisement::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $i=0;
        foreach ($advertisements as $advertisement){
            dispatch(new AdvertisementWeatherJobs($advertisement))->delay(now()->addSeconds($i));
            $i=+3;
        }
    }
}
