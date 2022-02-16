<?php


namespace App\Repositories;


use App\Models\Blogs;
use App\Models\Categories;
use App\Repositories\Interfaces\BlogsServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BlogsServiceRepository implements BlogsServiceRepositoryInterface
{
    public function getBlogs(): JsonResponse
    {
        return $this->getAllBlogs();
    }

    public function getCategories(): JsonResponse
    {
        $catgories = Categories::get();
        return response()->json(array('categories' => $catgories), 200);
    }

    public function getAllBlogs(): JsonResponse
    {
        $blogs = Blogs::with('author')->with('category')->get();
        return response()->json($blogs, 200);
    }

    public function getBlogByCategory($categoryId): JsonResponse
    {
        $blogs = Blogs::where('category_id', $categoryId)
            ->with('author')
            ->with('category')->paginate(10);

        return response()->json($blogs, 200);
    }

    public function filterBlog($keyword): JsonResponse
    {
        if (!empty($keyword)) {
            $filteredBlogs = Blogs::join('categories', 'blogs.category_id', 'categories.id')
                ->where('blogs.title', 'like', '%' . $keyword . '%')
                ->orWhere('categories.name', 'like', '%' . $keyword . '%')
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
