<?php

namespace App\Http\Controllers\Api;

use App\Events\ExportAdvertisements;
use App\Http\Controllers\Controller;
use App\Jobs\ExportAdvertisementsJob;
use App\Services\Export;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function advertisements()
    {
        dispatch((new ExportAdvertisementsJob())->delay(now()->addSeconds(15)));
        return response('status', 200);
    }
}
