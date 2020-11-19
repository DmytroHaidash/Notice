<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentsPaginatedResource;
use App\Models\Comment;
use App\Repository\CommentsRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        CommentsRepository::store($request);
        return response()->json('status', 200);
    }

    public function update(Request $request, Comment $comment)
    {
        CommentsRepository::update($request, $comment);
        return response()->json('status', 200);
    }

    public function items()
    {
        return response()->json(new CommentsPaginatedResource(Comment::paginate(5)));
    }
}
