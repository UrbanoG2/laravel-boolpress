@extends('layouts.admin')
@section('content')
<div class="container">

  <div class="row">
    <div class="col mt-3">
      <h1>Add new Category</h1>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
        <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        @method('POST')


        <div class="mb-3">
          <label for="name" class="form-label">Category name</label>
          <input type="text" class="form-control" id="name" name="name">

          @error('name')
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