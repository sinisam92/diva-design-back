<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
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
        $user = auth()->user()->id;

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->image_url = $request->input('image_url');
        $blog->content = $request->input('content');
        $blog->user_id = $user;
        $blog->save();

        return $this->show($blog->id);
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return response()->json([
            'message' => 'Deleted'
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user()->id;
        $blog = Blog::find($id);
        $blog->title = $request->input('title');
        $blog->image_url = $request->input('image_url');
        $blog->content = $request->input('content');
        $blog->user_id = $user;
        $blog->save();

        return $this->show($blog->id);
    }
}
