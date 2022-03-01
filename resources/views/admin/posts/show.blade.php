@extends('layouts.app')

@section('content')
    {{-- @dd($post) --}}

    <div class="container">
        <h2>
            {{ $post->title }}
        </h2>
    </div>
@endsection