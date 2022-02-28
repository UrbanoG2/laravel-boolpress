@extends('layouts.app')
@section('content')
<div class="container">

  <div class="row">
    <div class="col mt-3">
      <h1>Add new Post</h1>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
        <form action="{{ route('admin.posts.store') }}" method="post">
        @csrf
        @method('POST')

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">

          @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror

        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author">
  
            @error('author')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description">

          @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        

        <input class="btn btn-warning" type="submit" value="Invia">

        <a class="btn btn-danger ms-2" href="{{ url()->previous() }}">Go Back</a>

      </form>

    </div>
  </div>
</div>
@endsection