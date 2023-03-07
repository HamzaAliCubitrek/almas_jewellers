@php
    $layout = 'layouts.app';
@endphp

@if(Auth::user()->roles->pluck('name')[0] == "agents")
    @php
        $layout = 'layouts.agent-dashboard';
    @endphp
@endif

@extends($layout)
<style type="text/css">
    #dvPreview {
        filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);
        min-height: 400px;
        min-width: 400px;
        display: none;
    }

    .select_image {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: lightcoral;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        cursor: pointer;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row equal">
                    <div class="col-md-4">
                        <form id="profile-form">
                            <div class="card h-100">
                                <div class="card-header">
                                    <b>General Details</b>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group input-material">
                                                <input type="text" class="form-control w-100" name="contact" id='contact'
                                                    required value="{{ $editProfile->contact }}"
                                                    placeholder="e.g: +92XXXXXXX">
                                                <label>
                                                    Contact Number
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="col md 12">
                                        <a  href="{{ url('/') }}"><button type="button" class="btn btn-primary bg-danger float-end mb-2">Back</button></a>
                                        <button type="submit" class="btn btn-primary float-end mb-2" id="submit-btn">Save
                                            Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-8">
                        <form id="password_form">
                            <div class="card h-100">
                                <div class="card-header">
                                    <b>Change Password - Type atleast 8 characters</b>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group input-material">
                                                <input type="password" class="form-control w-100" name="current_password"
                                                    id="current_password">
                                                <label>Current password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group input-material">
                                                <input type="password" class="form-control w-100" name="new_password"
                                                    id="new_password">
                                                <label>New Password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group input-material">
                                                <input type="password" class="form-control w-100" name="confirm_password"
                                                    id="confirm_password">
                                                <label>Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="col md 12">
                                        <a  href="{{ url('/') }}"><button type="button" class="btn btn-primary bg-danger float-end mb-2">Back</button></a>
                                        <button type="submit" class="btn btn-primary float-end mb-2" id="submit-btn">Save
                                            Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@push('page-scripts')
    <script>
        $(document).ready(function() {
            $("#profile-form").validate({
                errorElement: 'span',
                rules: {
                    contact: {
                        required: true,
                        digits: true,
                    },
                },
                messages: {},
                submitHandler: function(form) {
                    $('#processing-spinner').show();
                    $('#submit-btn').hide();
                    var form_id = "profile-form";
                    var form_data = getAllFieldsInFormDataFormat(form_id);

                    $.ajax({
                        url: "{{ url('update-profile/' . Auth::user()->id) }}",
                        method: "POST",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(res) {
                            $('#processing-spinner').hide();
                            try {
                                var APP_URL = {!! json_encode(url('/')) !!};
                                const obj = JSON.parse(res);
                                if (obj.success == true) {
                                    $('#submit-btn').show();
                                    successSweetAlert(obj.message);

                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    $('#submit-btn').show();
                                    somethingWentWrongSweetAlert(obj.message);
                                    $('#submit-btn').show();
                                }
                            } catch (error) {
                                $('#submit-btn').show();
                                somethingWentWrongSweetAlert(error);
                            }
                        },
                        error: function(data) {
                            $('#submit-btn').show();
                            console.log(data.responseText);
                            somethingWentWrongSweetAlert(data.responseText.replace(/[^a-zA-Z ]/g, " "));
                        }
                    });
                }
            });

            $("#password_form").validate({
                errorElement: 'span',
                rules: {
                    current_password: {
                        required: true,
                    },
                    new_password: {
                        minlength: 8,
                        required: true,
                    },
                    confirm_password: {
                        minlength: 8,
                        equalTo: "#new_password"
                    },
                },
                messages: {},
                submitHandler: function(form) {
                    $('#processing-spinner').show();
                    $('#submit-btn').hide();
                    var form_id = "password_form";
                    var form_data = getAllFieldsInFormDataFormat(form_id);
                    form_data.append('csrf-token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ url('change-password') }}",
                        method: "POST",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function(res) {
                            try {
                                var APP_URL = {!! json_encode(url('/')) !!};
                                const obj = JSON.parse(res);
                                if (obj.success == true) {
                                    $('#submit-btn').show();
                                    successSweetAlert(obj.message);

                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    $('#submit-btn').show();
                                    somethingWentWrongSweetAlert(obj.message);
                                    $('#submit-btn').show();
                                }
                            } catch (error) {
                                $('#submit-btn').show();
                                somethingWentWrongSweetAlert(error);
                            }
                            $('#processing-spinner').hide();
                        },
                        error: function(data) {
                            $('#submit-btn').show();
                            console.log(data.responseText);
                            somethingWentWrongSweetAlert(data.responseText.replace(/[^a-zA-Z ]/g, " "));
                            $('#processing-spinner').hide();
                        }
                    });
                }
            });
        });
    </script>
@endpush
