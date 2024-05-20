<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index',[
            'blogs'=>Blog::latest()->paginate(5),
        ]);
    }

    // /----------------------/

    public function create()
    {
        return view('admin.blogs.create',[
            'categories'=>Category::all()
        ]);
    }
    public function store(PostRequest $request)
    {
        $cleanData = $request->validated();
        $cleanData['user_id']=auth()->id();
        Blog::create($cleanData);
        return redirect()->route('admin.dashboard');
    }
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit',[
            'blog'=> $blog,
            'categories'=>Category::all()
        ]);
    }
    public function update(PostRequest $request,Blog $blog)
    {
        $cleanData = $request->validated();
        $blog->update($cleanData);
        return redirect()->route('admin.dashboard');
    }
}
