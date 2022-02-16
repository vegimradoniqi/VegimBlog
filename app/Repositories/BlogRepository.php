<?php


namespace App\Repositories;


use App\Models\Blogs;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogRepository implements BlogRepositoryInterface
{
    public function storeBlog($blogData): JsonResponse
    {
        if ($blogData->hasFile('image')) {
            $file = $blogData->file('image');
            $filename = $file->getClientOriginalName();
            $file->storeAs('image', $filename, 'public');
        }

        $blog = new Blogs();
        $blog->title = $blogData->title;
        $blog->category_id = $blogData->category;
        $blog->description = $blogData->description;
        if (isset($filename)) {
            $blog->image = $filename;
        }
        $blog->user_id = Auth::id();

        if ($blog->save()) {
            return response()->json(['message' => 'Blog has been created successfully', 'success' => true], 200);
        }
    }

    public function deleteBlog($id): JsonResponse
    {
        $blog = Blogs::find($id);

        if ($blog->delete()) {
            return response()->json(['message' => 'Blog has been deleted successfully', 'success' => true], 200);
        }
    }

    public function restoreBlog($id): JsonResponse
    {
        $blog = Blogs::withTrashed()->where('id', $id);

        if ($blog->restore()) {
            return response()->json(['message' => 'Blog has been restored successfully', 'success' => true], 200);
        }
    }

    public function editBlog($blogData): JsonResponse
    {
        $blog = Blogs::find($blogData->id);
        if ($blog) {
            if ($blogData->hasFile('image')) {
                Storage::delete('image/' . $blog->image);
                $file = $blogData->file('image');
                $filename = $file->getClientOriginalName();
                $file->storeAs('image', $filename, 'public');
            }
        }
        $blog->title = $blogData->title;
        $blog->category_id = $blogData->category;
        $blog->description = $blogData->description;
        if (isset($filename)) {
            $blog->image = $filename;
        }
        $blog->user_id = Auth::id();

        if ($blog->save()) {
            return response()->json(['message' => 'Blog has been updated successfully', 'success' => true], 200);
        }
    }
}
