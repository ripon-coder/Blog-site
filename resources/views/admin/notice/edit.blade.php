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
        <h5 class="card-title">Update Notice</h5>
        <form action="{{route('admin-notice.update',$notice->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" value="{{$notice->title}}" name="title" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea id="summernote" name="description" class="form-control">{!! $notice->description!!}</textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Update Notice</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection