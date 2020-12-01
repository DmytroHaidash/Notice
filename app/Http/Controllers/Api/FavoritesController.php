<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\Advertisement;
use App\Models\Favorite;
use App\Repository\FavoritesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function add(Advertisement $advertisement)
    {
        $exists = Auth::user()->favorites()->where('advertisement_id', $advertisement->id)->first();
        if ($exists) {
             FavoritesRepository::destroy($exists);
        } else {
             FavoritesRepository::create($advertisement);
        }
        return response()->json(['status' => 200]);
    }

    public function check(Advertisement $advertisement)
    {
        return response()->json(Auth::user()->favorites->contains('advertisement_id', $advertisement->id));
    }

    public function count()
    {
        return response()->json(Auth::user()->favorites->count());
    }

    public function items()
    {
        return response()->json(FavoriteResource::collection(Auth::user()->favorites));
    }
}
