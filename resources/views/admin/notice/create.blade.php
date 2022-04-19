@extends('admin.adminlayout.app')
@section('content')
<div class="container">
  <div class="d-flex justify-content-center">
    <div class="card mt-4" style="width: 60rem;">
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
        <h5 class="card-title">Create Notice</h5>
        <form action="{{route('admin-notice.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" value="{{old('title')}}" name="title" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea id="summernote" name="description" class="form-control">{{old('description')}}</textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Add Notice</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection