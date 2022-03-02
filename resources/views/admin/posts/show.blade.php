@extends('layouts.admin')

@section('content')
    {{-- @dd($post) --}}

    <div class="container d-flex justify-content-between">
        <ul>
            <li>Title {{ $post->title }}</li>
            <li>Author: {{ $post->author }}</li>
            <li>Desription: {{ $post->text }}</li>
            <li>Category: {{ $post->category()->first()->name }}</li>
        </ul>


        <div>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
@endsection