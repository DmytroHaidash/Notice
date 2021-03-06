<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return response()->json(CategoryResource::collection(Category::all()));
    }

    public function parents()
    {
        return response()->json(CategoryResource::collection(Category::onlyParents()->get()));
    }
}
