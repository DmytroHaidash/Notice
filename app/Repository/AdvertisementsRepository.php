<?php

namespace App\Repository;


use App\Jobs\AdminsDeletedJobs;
use App\Jobs\DeleteFavoriteJobs;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementsRepository
{
    public static function store(Request $request)
    {
        $advertisement = Auth::user()->advertisements()->create(
            $request->only('title', 'description', 'phone', 'country', 'email', 'end_date', 'longitude', 'latitude', 'category_id')
        );

        return $advertisement;
    }

    public static function update(Request $request, Advertisement $advertisement)
    {
        $advertisement->update(
            $request->only('title', 'description', 'phone', 'country', 'email', 'end_date', 'longitude', 'latitude', 'category_id')
        );

        return $advertisement;
    }

    public static function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return true;
    }
}