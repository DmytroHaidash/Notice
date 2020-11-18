<?php

namespace App\Repository;


use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementsRepository
{
    public static function store(Request $request)
    {
        $advertisement = Auth::user()->advertisements()->create(
            $request->only('title', 'description', 'phone', 'country', 'email', 'end_date', 'longitude', 'latitude')
        );
        if($request->filled('image')){
            $advertisement->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('advertisement');
        }

        return $advertisement;
    }

    public static function update(Request $request, Advertisement $advertisement)
    {
        $advertisement->update(
            $request->only('title', 'description', 'phone', 'country', 'email', 'end_date', 'longitude', 'latitude')
        );
        if($request->filled('image')){
            $advertisement->clearMediaCollection('advertisement');
            $advertisement->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('advertisement');
        }

        return $advertisement;
    }
}