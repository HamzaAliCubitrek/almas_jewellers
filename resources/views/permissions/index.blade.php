@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Permission Management</h2>
        </div>
        <div class="pull-right text-right m-2">
            @can('permission-create')
                <a class="btn btn-success btn-sm" href="{{ route('permissions.create') }}"> Create New Permission</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible"  role="alert">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered datatable_listing">
  <thead>
    <tr>
     <th>No</th>
     <th>Name</th>
     <th>Status</th>
     <th width="280px">Action</th>
  </tr>
</thead>
  <tbody>
  @foreach ($permissions as $key => $permission)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $permission->name }}</td>
        <td>{{ $permission->deleted_at??'Active' }}</td>
        <td>
            @can('permission-show')
            <a class="btn btn-info btn-sm" href="{{ route('permissions.show',$permission->id) }}">Show</a>
            @endcan
            @can('permission-edit')
                <a class="btn btn-info btn-sm" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
            @endcan
            @can('permission-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
    </tbody>
</table>


{!! $permissions->render() !!}



@endsection
