<?php

namespace App\Repository;


use App\Models\Advertisement;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoritesRepository
{
    public static function create(Advertisement $advertisement)
    {
        $favorite = Auth::user()->favorites()->create(['advertisement_id' => $advertisement->id]);
        return $favorite;
    }

    public static function destroy(Favorite $favorite)
    {
        $favorite->delete();
    }

}