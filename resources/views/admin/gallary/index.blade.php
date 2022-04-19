@extends('admin.adminlayout.app')
@section('content')
<div class="container">

    <div class="d-flex justify-content-center">
        <div class="card mt-4" style="width: 60rem;">
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if(!$gallarys->isEmpty())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallarys as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->title}}</td>
                            <td><a href="{{ url(Storage::url('gallarys/' . $item->image)) }}"><img width="60"
                                        src="{{ url(Storage::url('gallarys/' . $item->image)) }}"></a></td>
                            <td><a href="{{route('admin-gallary.edit',$item->id)}}"><button type="button"
                                        class="btn btn-primary btn-sm">Edit</button></a></td>
                            <td>
                                {{ Form::open(array('url' =>URL::Route("admin-gallary.destroy", $item->id), 'method' => 'DELETE', 'name'
                                => 'delete')) }}
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!!$gallarys->links("pagination::bootstrap-5")!!}
                @else
                <div class="alert alert-danger" role="alert">
                    Gallary is empty!
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection