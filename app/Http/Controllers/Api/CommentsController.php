<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentsRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentsPaginatedResource;
use App\Models\Advertisement;
use App\Models\Comment;
use App\Repository\CommentsRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Advertisement $advertisement)
    {
        return response()->json(new CommentsPaginatedResource($advertisement->comments()->latest()->paginate(5)));
    }

    public function store(CommentsRequest $request)
    {
        $comment = CommentsRepository::store($request);
        return response()->json(new CommentResource($comment));
    }

    public function update(CommentsRequest $request, Comment $comment)
    {
        $comment = CommentsRepository::update($request, $comment);
        return response()->json(new CommentResource($comment));
    }
}
