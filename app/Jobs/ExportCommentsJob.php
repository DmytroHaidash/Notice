<?php

namespace App\Jobs;

use App\Events\ExportComments;
use App\Models\Advertisement;
use App\Services\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportCommentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $advertisement;

    /**
     * ExportCommentsJob constructor.
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
        $file = Export::comments($this->advertisement);
        event(new ExportComments($file));
    }
}
