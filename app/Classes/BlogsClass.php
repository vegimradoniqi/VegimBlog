<?php


namespace App\Classes;


use App\Models\Blogs;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogsClass
{
    protected $request;
    protected $response;


    /**
     * @param $request
     * @return $this
     */
    public function setInput($request)
    {
        $this->request = $request;
        return $this;
    }
    /**
     * Handle all
     * @return $this
     */
    public function handle()
    {
        $request = $this->request;
        if ($request->type == 'getCategories')
        {
            $this->getCategories();
        }
        if ($this->request->type == "storeBlog")
        {
            $this->storeBlog($request);
        }
        if ($this->request->type == "getBlogs")
        {
            $this->getBlogs();
        }
        if ($this->request->type == "deleteBlog")
        {
            $this->deleteBlog($request);
        }
        if ($this->request->type == "restoreBlog")
        {
            $this->restoreBlog($request);
        }
        if ($this->request->type == "editBlog")
        {
            $this->editBlog($request);
        }
        return $this;
    }
    protected function getCategories()
    {
        $catgories = Categories::get();
        $this->response = response()->json(array('categories' => $catgories), 200);
    }

    protected function storeBlog($request)
    {

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename =  $file->getClientOriginalName();
            $file->storeAs('image',$filename,'public');
        }

        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->category_id = $request->category;
        $blog->description = $request->title;
        $blog->image = $filename;
        $blog->user_id = Auth::id();

        if ($blog->save()){
            $this->response = response()->json(['message'=>'Blog has been created successfully','success'=>true],200);
        }

    }

    protected function getBlogs ()
    {
        $blogs = Blogs::with('author')->with('category')->get();
        $this->response = response()->json($blogs,200);
    }

    protected function deleteBlog ($request)
    {
        $blog = Blogs::find($request->id);

        if ($blog->delete()){
            $this->response = response()->json(['message'=>'Blog has been deleted successfully','blog_id'=>$request->id,'success'=>true],200);
        }
    }
    protected function restoreBlog ($request)
    {
        $blog = Blogs::withTrashed()->where('id',$request->id);

        if ($blog->restore()){
            $this->response = response()->json(['message'=>'Blog has been restored successfully','success'=>true],200);
        }
    }
    protected function editBlog($request)
    {
        $blog = Blogs::find($request->id);
        if ($blog)
        {
            if($request->hasFile('image')){
                Storage::delete('image/'.$blog->image);
                $file = $request->file('image');
                $filename =  $file->getClientOriginalName();
                $file->storeAs('image',$filename,'public');
            }
        }
        $blog->title = $request->title;
        $blog->category_id = $request->category;
        $blog->description = $request->title;
        $blog->image = $filename;
        $blog->user_id = Auth::id();

        if ($blog->save()){
            $this->response = response()->json(['message'=>'Blog has been updated successfully','success'=>true],200);
        }
    }
    public function getResponse()
    {
        return $this->response;
    }
}
