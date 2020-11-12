<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertisementPaginatedResource;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
//        dd($request->all());
        $advertisement = Auth::user()->advertisements()->create(
            $request->only('title', 'description', 'phone', 'country', 'email', 'end_date')
        );
        if($request->filled('image')){
            $advertisement->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('advertisement');
        }
        return response()->json('status', 200);
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        dd($request->all());
    }
}
