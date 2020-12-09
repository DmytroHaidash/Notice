<?php

namespace App\Http\Controllers\Api;

use App\Events\ExportAdvertisements;
use App\Http\Controllers\Controller;
use App\Services\Export;
use Illuminate\Http\Request;

class ExportsController extends Controller
{
    public function advertisements()
    {
        $export = new Export();
        $file = $export->advertisements();
        dd($file);
//        event(new ExportAdvertisements($export->advertisements()));
        return response('status', 200);
    }
}
