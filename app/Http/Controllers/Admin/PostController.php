<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = Category::all();
        $data = $request->all();
        $newPost = new Post();
        $newPost->user_id = Auth::user()->id;
        $newPost->title = $data["title"];
        $newPost->author = Auth::user()->name;
        $newPost->content = $data["content"];
        $newPost->image_url = $data["image_url"];
        $newPost->slug = Str::slug($data["title"], "-");
        $newPost->save();

        return redirect()->route("admin.posts.show", compact("newPost", "categories"));

    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $categories = Category::where);
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("admin.posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $categories = Category::all();
        $data = $request->all();
        $post->user_id = Auth::user()->id;
        $post->title = $data["title"];
        $post->author = Auth::user()->name;
        $post->content = $data["content"];
        $post->image_url = $data["image_url"];
        $post->slug = Str::slug($data["title"], "-");
        $post->save();

        return redirect()->route("admin.posts.show", compact("post", "categories"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
