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
        <h5 class="card-title">Update Blog</h5>
        <form action="{{route('admin-blog.update',$blog->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Title*</label>
            <input type="text" value="{{$blog->title}}" name="title" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Category*</label>
            <select name="category" class="form-select" aria-label="Default select example">
              <option value="0" selected>--Select One--</option>
              @foreach ($categorys as $item)
                <option @if($blog->category == $item->id) selected @endif value="{{$item->id}}">{{$item->category}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Image*</label>
            <input type="file" name="image" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea id="summernote" name="description" class="form-control">{!! $blog->description!!}</textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-sm">Update Blog</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection