<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentsPaginatedResource;
use App\Models\Comment;
use App\Repository\CommentsRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        return response()->json(new CommentsPaginatedResource(Comment::latest()->paginate(5)));
    }

    public function store(Request $request)
    {
        $comment = CommentsRepository::store($request);
        return response()->json(new CommentResource($comment));
    }

    public function update(Request $request, Comment $comment)
    {
        $comment = CommentsRepository::update($request, $comment);
        return response()->json(new CommentResource($comment));
    }
}
