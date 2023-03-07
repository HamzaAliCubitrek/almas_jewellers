@extends('layouts.app')

@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Karat</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    {{-- @can('client-create') --}}
                    <a class="btn btn-danger" href="{{ url('karat/create') }}">
                        <i class="fas fa-plus mr-2"></i>
                        Create
                    </a>
                    {{-- @endcan --}}
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Item Listing</li>
                        <li class="breadcrumb-item active">Item</li>
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
                            <th>Categories</th>
                            <th>Description</th>
                            <th>Purity</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th width="280px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karat as $key => $karat)
                            <tr id="row_{{ $key }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $karat->name }}</td>
                                <td>{{ $karat->category_id }}</td>
                                <td>{{ $karat->description }}</td>
                                <td>{{ $karat->purity }}</td>
                                <td>{{ $karat->quantity }}</td>

                                <td>{{ $karat->status == 1 ? 'Active' : 'In-Active' }}</td>
                                <td>
                                    <ul class="list-inline">

                                        <li class="list-inline-item">
                                            <a href="{{ url('karat/edit', $karat->id) }}">
                                                <img src="{{ asset('viewly_assets/dist/img/pencil.png') }}" />
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="{{ url('karat/show', $karat->id) }}">
                                                <img src="{{ asset('viewly_assets/dist/img/eye.png') }}" />
                                            </a>
                                        </li>


                                        @php
                                            $deleteBtn = url('karat/destroy', $karat->id);
                                        @endphp
                                        <li class="list-inline-item">
                                            <a href="#"
                                                onclick="deleteByAxios('row_{{ $key }}', '{{ $deleteBtn }}')">
                                                <img src="{{ asset('viewly_assets/dist/img/trash.png') }}" />
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Description</th>
                            <th>Purity</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th width="280px;">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
