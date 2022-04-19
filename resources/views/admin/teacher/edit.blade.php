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
        <h5 class="card-title">Update Teacher</h5>
        <form action="{{route('admin-teacher.update',$teacher->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Name*</label>
            <input type="text" value="{{$teacher->name}}" name="name" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Designation*</label>
            <input type="text" value="{{$teacher->designation}}" name="designation" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Facebook URL</label>
            <input type="text" value="{{$teacher->fb}}" name="facebook" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Twitter URL</label>
            <input type="text" value="{{$teacher->twitter}}" name="twitter" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Instragram URL</label>
            <input type="text" value="{{$teacher->instragram}}" name="instragram" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary btn-sm">Update Teacher</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection