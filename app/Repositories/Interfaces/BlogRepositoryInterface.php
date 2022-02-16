<?php


namespace App\Repositories\Interfaces;


interface BlogRepositoryInterface
{
    public function storeBlog($blogData);

    public function deleteBlog($id);

    public function restoreBlog($id);

    public function editBlog($blogData);
}
