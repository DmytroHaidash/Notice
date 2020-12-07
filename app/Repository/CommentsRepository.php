<?php

namespace App\Repository;


use App\Jobs\NewCommentsJob;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsRepository
{
    public static function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'advertisement_id' => $request->input('advertisement_id'),
            'content' => $request->input('content')
        ]);
        dispatch(new NewCommentsJob($comment));
        return $comment;
    }

    public static function update(Request $request, Comment $comment)
    {
        $comment->update($request->only('content'));
        return $comment;
    }
}