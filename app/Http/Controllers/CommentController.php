<?php

namespace App\Http\Controllers;

use App\Mail\NotifyUser;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Blog $blog)
    {
        $cleanData = (request()->validate([
            'body'=>'required'
        ]));
        // $cleanData['blog_id']= $blog->id;
        $cleanData['user_id']=auth()->id();
        
        // Comment::create($cleanData);
        $comment = $blog->comments()->create($cleanData);
        
        
        $blog->subscribedUsers->filter(function($user)
        {
            return $user->id!==auth()->id();
        })->each(function($user) use($comment)
        {
            Mail::to($user->email)->queue(new NotifyUser($comment,$user));
        });

        return back();
    }
}
