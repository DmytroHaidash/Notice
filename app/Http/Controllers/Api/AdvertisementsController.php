<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementsRequest;
use App\Http\Resources\AdvertisementPaginatedResource;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Category;
use App\Repository\AdvertisementsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdvertisementsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return response()->json(new AdvertisementPaginatedResource(Advertisement::paginate(15)));
    }

    public function categoryItems(Category $category)
    {
        return response()->json(new AdvertisementPaginatedResource(Advertisement::where('category_id', $category->id)->paginate(15)));
    }

    /**
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Advertisement $advertisement)
    {
        return response()->json(new AdvertisementResource($advertisement));
    }

    /**
     * @param AdvertisementsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdvertisementsRequest $request)
    {
        AdvertisementsRepository::store($request);
        return response()->json('status', 200);
    }

    /**
     * @param AdvertisementsRequest $request
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdvertisementsRequest $request, Advertisement $advertisement)
    {
        AdvertisementsRepository::update($request, $advertisement);
        return response()->json('status', 200);
    }

    public function destroy(Advertisement $advertisement){
        if(Auth::user()->id == $advertisement->user_id || Auth::user()->role == 'admin' ){
            AdvertisementsRepository::destroy($advertisement);
            return response()->json('status', 200);
        }
        return response()->json('error', 403);
    }
}
