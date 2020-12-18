<?php

namespace App\Services;


use App\Jobs\AdminsDeletedJobs;
use App\Jobs\DeleteFavoriteJobs;
use App\Models\Advertisement;
use App\Repository\AdvertisementsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementsService
{
    public static function store(Request $request)
    {
       $advertisement = AdvertisementsRepository::store($request);
        if ($request->filled('image')) {
            $advertisement->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('advertisement');
        }

        return $advertisement;
    }

    public static function update(Request $request, Advertisement $advertisement)
    {
        $advertisement = AdvertisementsRepository::update($request, $advertisement);
        if ($request->filled('image')) {
            $advertisement->clearMediaCollection('advertisement');
            $advertisement->addMediaFromBase64($request->input('image'))
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection('advertisement');
        }

        return $advertisement;
    }

    public static function destroy(Advertisement $advertisement)
    {
        AdvertisementsRepository::destroy($advertisement);
        if (Auth::user()->role == 'admin') {
            dispatch(new AdminsDeletedJobs($advertisement));
        }
        dispatch(new DeleteFavoriteJobs($advertisement));

        return true;
    }
}