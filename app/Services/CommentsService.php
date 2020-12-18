<?php

namespace App\Services;


use App\Jobs\NewCommentsJob;
use App\Repository\CommentsRepository;
use Illuminate\Http\Request;

class CommentsService
{
    public static function store(Request $request){
        $comment = CommentsRepository::store($request);
        dispatch(new NewCommentsJob($comment));
        return $comment;
    }
}