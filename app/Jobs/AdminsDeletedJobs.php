<?php

namespace App\Jobs;

use App\Mail\AdminsDeletedAdvertisement;
use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AdminsDeletedJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $advertisement;

    /**
     * AdminsDeletedJobs constructor.
     * @param Advertisement $advertisement
     */
    public function __construct(Advertisement $advertisement )
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
        Mail::send(new AdminsDeletedAdvertisement($this->advertisement));
    }
}
