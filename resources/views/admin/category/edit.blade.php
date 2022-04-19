@extends('admin.adminlayout.app')
@section('content')
<div class="container">
  <div class="d-flex justify-content-center">
    <div class="card mt-4" style="width: 45rem;">
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li class="list-unstyled">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <h5 class="card-title">Update category</h5>
        <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Category*</label>
            <input type="text" name="category" value="{{$category->category}}" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Update category</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection