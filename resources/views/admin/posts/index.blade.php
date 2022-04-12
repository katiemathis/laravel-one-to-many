@extends('admin.layouts.base')

@section('content')

    <div class="container">
        <table class="table">

            <a href="{{route('admin.posts.create')}}" class="btn btn-warning mb-3">Create new post</a>
            
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Slug</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a></td>
                        <td>{{substr($post->content, 0, 30)}}</td>
                        <td>{{$post->slug}}</td>
                        <td class="d-flex">    
                            <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary m-2">View</a>
                            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-secondary m-2">Edit</a>

                            <form method="POST" action="{{route('admin.posts.destroy', $post->id)}}">
                            
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger m-2">
                                        DELETE
                                    </button>
                            
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection