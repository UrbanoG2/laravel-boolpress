@extends('layouts.admin')
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

        <select class="form-select mb-3" name="category_id">
          {{-- se la categoria scelta dall'utente precedentemente e' 
          identica a quella su cui sto girando inserisco
          l'attributo selected --}}
          <option value="">Select a category</option>

              @foreach ($categories as $category)
             
              <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}"> 
              {{ $category->name }}</option>
          @endforeach
        </select>


          <fieldset class="mb-3">
            <legend>Tags</legend>
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </fieldset>

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

        {{-- <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug">
  
            @error('slug')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div> --}}

        
        <div class="mb-3">
          <label for="text" class="form-label">Text</label>
          <input type="text" class="form-control" id="text" name="text">

          @error('text')
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