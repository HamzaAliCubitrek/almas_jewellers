@extends('layouts.app')


@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Role</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    @can('role-create')
                        <a class="btn btn-danger" href="{{ url('roles/create') }}">
                            <i class="fas fa-plus mr-2"></i>
                            Create
                        </a>
                    @endcan
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Role Listing</li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover datatable_listing">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr id="row_{{ $key }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->deleted_at ?? 'Active' }}</td>
                                <td>
                                    <ul class="list-inline">
                                        @can('role-edit')
                                            <li class="list-inline-item">
                                                <a href="{{ url('roles/edit', $role->id) }}">
                                                    <img src="{{ asset('viewly_assets/dist/img/pencil.png') }}" />
                                                </a>
                                            </li>
                                        @endcan

                                        @can('role-show')
                                            <li class="list-inline-item">
                                                <a href="{{ url('roles/show', $role->id) }}">
                                                    <img src="{{ asset('viewly_assets/dist/img/eye.png') }}" />
                                                </a>
                                            </li>
                                        @endcan

                                        @can('role-delete')
                                            @php
                                                $deleteBtn = url('roles/destroy', $role->id);
                                            @endphp
                                            <li class="list-inline-item">
                                                <a href="#"
                                                    onclick="deleteByAxios('row_{{ $key }}', '{{ $deleteBtn }}')">
                                                    <img src="{{ asset('viewly_assets/dist/img/trash.png') }}" />
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {!! $roles->render() !!}
@endsection
