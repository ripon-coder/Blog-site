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
        <h5 class="card-title">Update Slider</h5>
        <form action="{{route('slider.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" name="title" value="{{$slider->title}}" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Image*</label>
            <input type="file" name="image" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10">{{$slider->description}}</textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Update Slider</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection