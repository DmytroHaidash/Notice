<?php

namespace App\Jobs;

use App\Models\Advertisement;
use App\Services\WeatherService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class AdvertisementWeatherJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $advertisement;

    /**
     * AdvertisementWeatherJobs constructor.
     * @param Advertisement $advertisement
     */
    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $key = 'advertisement_' . $this->advertisement->id;
        if(Cache::has($key)){
            Cache::forget($key);
        }
        $weather = (new WeatherService())->getWeather($this->advertisement);
        Cache::store('file')->put($key, $weather, 12*60*60);
    }
}
