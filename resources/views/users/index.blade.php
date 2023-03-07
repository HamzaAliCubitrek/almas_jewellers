@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right text-right">
            @can('user-create')
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}"> Create New User</a>
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
   <th>Email</th>
   <th>Username</th>
   <th>Contact</th>
   <th>Roles</th>
   <th>Status</th>
   <th width="280px">Action</th>
 </tr>
    </thead>
    <tbody>
 @foreach ($users as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->user_name }}</td>
    <td>{{ $user->contact }}</td>
    <td>
        @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
        <label class="badge badge-success">{{ $v }}</label>
        @endforeach
        @endif
    </td>
    <td>{{ $user->deleted_at??'Active' }}</td>
    <td>
        @can('user-show')
        <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
        @endcan
        @can('user-edit')
        <a class="btn btn-info btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
        @endcan
        @can('user-delete')
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
        {!! Form::close() !!}
        @endcan
    </td>
  </tr>
 @endforeach
</tbody>
</table>


{!! $users->render() !!}



@endsection
