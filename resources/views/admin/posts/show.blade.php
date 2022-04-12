@extends('admin.layouts.base')

@section('content')

    <div class="container">
            <h1>{{$post->title}}</h1>
            <h6>{{$post->created_at}}</h6>
            <div class="card m-5" style="width: 50rem;">
                <div class="card-body">
                <h5 class="card-title"><strong>Title: </strong>{{$post->title}}</h5>
                <p class="card-text"><strong>Content: </strong>{!! $post->content !!}</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">Created: {{$post->created_at}}</li>
                <li class="list-group-item">By: {{$user->name ?? ''}}</li>
                <li class="list-group-item">Slug: {{$post->slug}}</li>
                @if(is_null($post->category)) 
                    <li class="list-group-item">Category: </li>
                @else
                    <li class="list-group-item">Category: {{$post->category->category_name}}</li>
                @endif
                </ul>
            </div>
            <a type="button" class="btn btn-primary" href="{{route('admin.posts.index')}}" role="button">Go Back</a>
    </div>

@endsection