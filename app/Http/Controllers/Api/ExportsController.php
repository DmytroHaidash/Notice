<?php

namespace App\Http\Controllers\Api;

use App\Events\ExportAdvertisements;
use App\Http\Controllers\Controller;
use App\Jobs\ExportAdvertisementsJob;
use App\Jobs\ExportUsersJob;
use App\Services\Export;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function advertisements()
    {
        dispatch((new ExportAdvertisementsJob())->delay(now()->addSeconds(5)));
        return response('status', 200);
    }

    public function users()
    {
        dispatch((new ExportUsersJob())->delay(now()->addSeconds(5)));
        return response('status', 200);
    }
}
