@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-6 py-3">
            <form class="text-center" action="{{route("admin.posts.update", $post)}}" method="POST">
                @csrf
                @method("PUT")
                <div class="input-group mb-3">
                    <span class="input-group-text">Title</span>
                    <input type="text" class="form-control" name="title" value="{{$post->title}}">
                </div>
                <div class="d-flex flex-wrap py-2">
                    @foreach ($categories as $category)
                    <div class="form-check me-5">
                        <input class="form-check-input" type="checkbox" name="category[]" value="{{$category->id}}"
                        {{ $post->categories->contains($category) ? "checked" : "" }}>
                        <label class="form-check-label" for="{{$category->name}}">
                            {{ $category->name }}    
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Content</span>
                    <input type="text" class="form-control" name="content" value="{{$post->content}}">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Image</span>
                    <input type="text" class="form-control" name="image_url" value="{{$post->image_url}}">
                </div>

                <button class="btn btn-primary" type="submit">Modifica</button>
            </form>
        </div>
    </div>
</div>
@endsection
