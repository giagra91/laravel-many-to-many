@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-6 py-3">
            <form class="text-center" action="{{route("admin.posts.store")}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">Title</span>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Content</span>
                    <input type="text" class="form-control" name="content">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Image</span>
                    <input type="text" class="form-control" name="image_url">
                </div>

                <button class="btn btn-primary" type="submit">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection