<?php


namespace App\Repositories\Interfaces;


interface BlogsServiceRepositoryInterface
{
    public function getCategories();

    public function getBlogs();

    public function getAllBlogs();

    public function getBlogByCategory($categoryId);

    public function filterBlog($keyword);
}
