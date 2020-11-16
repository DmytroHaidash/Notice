<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementsRequest;
use App\Http\Resources\AdvertisementPaginatedResource;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;


class AdvertisementsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function items(){
        return response()->json(new AdvertisementPaginatedResource(Advertisement::paginate(15)));
    }

    /**
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function item(Advertisement $advertisement)
    {
        return response()->json(new AdvertisementResource($advertisement));
    }

    /**
     * @param AdvertisementsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdvertisementsRequest $request)
    {
        $advertisement = Auth::user()->advertisements()->create(
            $request->only('title', 'description', 'phone', 'country', 'email', 'end_date', 'longitude', 'latitude')
        );
        if($request->filled('image')){
            $advertisement->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('advertisement');
        }
        return response()->json('status', 200);
    }

    /**
     * @param AdvertisementsRequest $request
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data
     */
    public function update(AdvertisementsRequest $request, Advertisement $advertisement)
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
        return response()->json('status', 200);
    }
}
