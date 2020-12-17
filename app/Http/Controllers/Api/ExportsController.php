<?php

namespace App\Http\Controllers\Api;

use App\Events\ExportAdvertisements;
use App\Http\Controllers\Controller;
use App\Jobs\ExportAdvertisementsJob;
use App\Jobs\ExportCommentsJob;
use App\Jobs\ExportUsersJob;
use App\Models\Advertisement;
use App\Services\Export;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function advertisements()
    {
        dispatch((new ExportAdvertisementsJob())->delay(now()->addSeconds(5)));
        return response('ok', 200);
    }

    public function users()
    {
        dispatch((new ExportUsersJob())->delay(now()->addSeconds(5)));
        return response('ok', 200);
    }

    public function comments(Advertisement $advertisement)
    {
        dispatch((new ExportCommentsJob($advertisement))->delay(now()->addSeconds(5)));
        return response('ok', 200);
    }
}
