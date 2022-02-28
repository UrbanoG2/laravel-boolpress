@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col mt-3 mb-5 text-center">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-warning">Create new post</a>
    </div>
</div>
@endsection
