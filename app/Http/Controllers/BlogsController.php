<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {
        $query = Blog::query();
        $query->with(['user']);

        return response()->json([
            'blogs' =>  $query->latest()->paginate(3)
        ]);
    }
    public function show($id)
    {
        return Blog::with(['user'])->find($id);
    }
    public function store(BlogRequest $request)
    {
        // $user = auth();
        // dd(auth()->user());
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->image_url = $request->input('image_url');
        $blog->content = $request->input('content');
        $blog->user_id = auth()->user()->id;
        $blog->save();

        return $this->show($blog->id);
    }
}
