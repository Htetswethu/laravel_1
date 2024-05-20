<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;



class BlogController extends Controller
{
    function index () 
    {
        return view('blogs.index',[
            'blogs' => Blog::with('category','author')
            ->latest()
            ->filter(request(['search','author','category']))
            ->paginate(5)
        ]);
         
    }
    
    function showCatBlog (Category $category) 
    {
        return view ('blogs.index',[
            'blogs'=> $category->posts->load('category'),
            // 'categories'=>Category::all(),
            // 'currentCategory'=>$category
        ]);
    }
    function show(Blog $blog)
    {
        return view ('blogs.show',[
            'blog' => $blog,
            'randomBlogs'=> Blog::inRandomOrder()->take(3)->get()
        ]);
    }
    function showAuthorBlog (User $author) 
    {
        return view ('blogs.index',[
            'blogs'=> $author->blogs->load('category','author'),
            // 'categories'=>Category::all()
        ]);
    }
}
