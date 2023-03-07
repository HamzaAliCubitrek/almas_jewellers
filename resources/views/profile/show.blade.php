@php
    $layout = 'layouts.app';
@endphp

@if(Auth::user()->roles->pluck('name')[0] == "agents")
    @php
        $layout = 'layouts.agent-dashboard';
    @endphp
@endif

@extends($layout)

@section('content')

        <div class="main-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            <div class="row gutters-sm">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{asset('viewly_assets/dist/img/user-default.png')}}" alt="Admin"
                                    class="rounded-circle" style="object-position: center;height: 200px;object-fit: cover;width: 200px;">
                                <div class="mt-3">
                                    <h4>{{ "@" . Auth::user()->name }}</h4>
                                    <h5 class="text-blue mb-1">#{{preg_replace('/[^A-Za-z0-9\-]/','',Auth::user()->roles->pluck('name'))}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Contact Number</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->contact }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->user_name }}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info" href="{{ url('/') }}"><i class="fas fa-long-arrow-alt-left" style="padding-right:8px;"></i>Back</a>
                                    <a class="btn btn-danger" href="{{ url('edit-profile/'.Auth::user()->id) }}"><i class="fas fa-pencil-alt" style="padding-right:8px;"></i>Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

@endsection
