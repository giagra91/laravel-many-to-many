<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Cookie;
use App\Models\Post;
use App\User;
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
        // $posts = Post::all();
        $posts = Post::where("user_id", Auth::user()->id)->get();
        return view('admin.posts.index', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newPost = new Post();
        $newPost->user_id = Auth::user()->id;
        $newPost->title = $data["title"];
        $newPost->content = $data["content"];
        $newPost->image_url = $data["image_url"];
        $newPost->slug = Str::slug($data["title"], "-");
        $newPost->save();

        $newPost->categories()->sync($data["category"]);

        return redirect()->route("admin.posts.index")->with("created-message", "$newPost->title è stato creato con successo");

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
        $categories = Category::all();
        return view("admin.posts.edit", compact("post", "categories"));
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
        $data = $request->all();
        $post->user_id = Auth::user()->id;
        $post->title = $data["title"];
        $post->categories()->sync($data["category"]);
        $post->content = $data["content"];
        $post->image_url = $data["image_url"];
        $post->slug = Str::slug($data["title"], "-");
        $post->save();

        return redirect()->route("admin.posts.show", compact("post"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route("admin.posts.index")->with("deleted.message", "$post->title è stato cancellato con successo");
    }

    public function categories(){
        return $this->belongsToMany("App\Models\Category");
    }
}
