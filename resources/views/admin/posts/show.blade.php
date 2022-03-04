@extends('layouts.admin')

@section('content')
    {{-- @dd($post) --}}

    <div class="container d-flex justify-content-between">
        <ul>
            <li>Title {{ $post->title }}</li>
            <li>Author: {{ $post->author }}</li>
            <li>Desription: {{ $post->text }}</li>
            <li>Category: {{ $post->category()->first()->name }}</li>
            <li>Tag: 
                <ul>
                    @foreach ($post->tags()->get() as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach    
                </ul>
            </li>

        </ul>


        <div class="buttons d-flex">
            <div>
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">Edit</a>
            </div>
    
            <div  class="ms-3">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-warning">See all posts</a>
            </div>
        </div>
    </div>
@endsection