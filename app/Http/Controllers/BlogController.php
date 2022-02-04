<?php

namespace App\Http\Controllers;

use App\Classes\BlogsClass;
use App\Models\Blogs;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function blogHandle(Request $request)
    {
        if (!empty($request)) {
            return (new BlogsClass())->setInput($request)->handle()->getResponse();
        } else {
            return response()->json('error', 500);
        }
    }

    public function getAllBlogs()
    {
        $blogs = Blogs::with('author')->with('category')->get();
        return response()->json($blogs,200);
    }

    public function getBlogByCategory(Request $request)
    {
        $blogs = Blogs::where('category_id',$request->category_id)
            ->with('author')
            ->with('category')->paginate(10);

        return response()->json($blogs,200);
    }

    public function filterBlog(Request $request)
    {
        if (!empty($request->keyword))
        {
            $filteredBlogs= Blogs::join('categories', 'blogs.category_id', 'categories.id')
                ->where('blogs.title', 'like', '%' . $request->keyword . '%')
                ->orWhere('categories.name', 'like', '%' . $request->keyword . '%')
                ->selet('blogs.*')
                ->with('author')
                ->with('category')
                ->paginate(10);
        } else {
            $filteredBlogs = Blogs::with('author')
                ->with('category')
                ->paginate(10);
        }


        return response()->json($filteredBlogs, 200);
    }
}
