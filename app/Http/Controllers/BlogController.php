<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\BlogsServiceRepositoryInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private BlogRepositoryInterface $blogRespository;
    private BlogsServiceRepositoryInterface $blogServiceRepository;

    public function __construct(BlogRepositoryInterface $blogRespository, BlogsServiceRepositoryInterface $blogServiceRepository)
    {
        $this->blogRespository = $blogRespository;
        $this->blogServiceRepository = $blogServiceRepository;
    }

    public function storeBlog(Request $request)
    {
        return $this->blogRespository->storeBlog($request);
    }

    public function deleteBlog(Request $request)
    {
        return $this->blogRespository->deleteBlog($request->id);
    }

    public function restoreBlog(Request $request)
    {
        return $this->blogRespository->restoreBlog($request->id);
    }

    public function editBlog(Request $request)
    {
        return $this->blogRespository->editBlog($request);
    }

    public function getCategories()
    {
        return $this->blogServiceRepository->getCategories();
    }

    public function getBlogs()
    {
        return $this->blogServiceRepository->getBlogs();
    }

    public function getAllBlogs()
    {
        return $this->blogServiceRepository->getAllBlogs();
    }

    public function getBlogByCategory(Request $request)
    {
        return $this->blogServiceRepository->getBlogByCategory($request->category_id);
    }

    public function filterBlog(Request $request)
    {
        return $this->blogServiceRepository->filterBlog($request->keyword);
    }
}
