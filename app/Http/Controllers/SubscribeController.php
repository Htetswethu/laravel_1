<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function toggle(Blog $blog)
    {
        if($blog->isSubscribed())
        {
            $blog->subscribedUsers()->detach(auth()->id()); // subscribed, button - unsubscribe
            return back()->with('danger', 'unsubscribed successfully');
            
        }else{
            $blog->subscribedUsers()->attach(auth()->id()); // unsubscribed, button- subscribe
            return back()->with('success', 'subscribed successfully');
        }
    }
}
