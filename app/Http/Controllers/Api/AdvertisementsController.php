<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertisementPaginatedResource;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementsController extends Controller
{
    public function items(){
        return response()->json(new AdvertisementPaginatedResource(Advertisement::paginate(15)));
    }

    public function item(Advertisement $advertisement)
    {
        return response()->json(new AdvertisementResource($advertisement));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        dd($request->all());
    }
}
