@extends('layouts.app')

@section('content')
<div class="container-fluid w-75 mx-auto">
    <div>
        <a href="{{route("admin.posts.create")}}" class="btn btn-primary">Aggiungi post</a>
    </div>
    @if (session("created-message"))
        <div class="alert alert-success">
            {{ session("created-message") }}
        </div>
    @endif
    @if (session("deleted-message"))
        <div class="alert alert-warning">
            {{ session("deleted-message") }}
        </div>
    @endif
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Created</th>
                <th>Categories</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($posts as $post)
                <tr>
                    <td>
                        <a href="{{route("admin.posts.show", $post)}}">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td>
                        {{ $post->user->name }}
                    </td>
                    <td>
                        {{ $post->created_at }}
                    </td>
                    <td>
                        @foreach ($post->categories as $category)
                            <span class="badge rounded-pill px-3 py-2" style="background-color: {{$category->color}}">{{$category->name}}</span>
                        @endforeach
                    </td>
                    <td class="d-flex">
                        <a href="{{route("admin.posts.edit", $post)}}" class="btn btn-success btn-sm me-2">Edit</a>
                        <form class="form-destroyer" 
                        action="{{route("admin.posts.destroy", $post)}}" 
                        post-title="{{ $post->title }}" method="post">
                        @csrf
                        @method("DELETE")

                        <button type="submit" class="btn btn-warning btn-sm ">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">There are no posts to show</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('footer-scripts')
    <script defer>
        const deleteForms = document.querySelectorAll(".form-destroyer");
        console.log(deleteForms);
        deleteForms.forEach(singleForm => {
            singleForm.addEventListener("submit", function(event){
                event.preventDefault(); // Blocco l'invio del form
                userConfirmation = window.confirm(`Vuoi davvero cancellare il post ${this.getAttribute(`post-title`)}?`);
                if(userConfirmation){
                    this.submit();
                }
            });
        });
    </script>
@endsection