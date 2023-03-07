@extends('layouts.app')

@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Role</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    <a class="btn btn-info" href="{{ url('roles') }}"> Back</a>
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Add Role</li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0">
                    <h2 class="card-title">Please Fill Required Fields <span class="text-danger">*</span></h2>
                </div>

                <div class="card-body">
                    <form id="role_form">
                        <input type="hidden" name="id" id="id" value="{{ isset($data->id) ? $data->id : '' }}">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label>Role Name</label>
                                <div class="form-line">
                                    <input placeholder="Name" class="form-control" name="name" type="text" value="{{ isset($data->name) ? $data->name : '' }}">
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="row mb-3">
                                    <h5 class="fw-bold">Mark given permissions below, which you want to assign to role.</h5>
                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="input-group">
                                            <div class="form-line" id="all_permission">

                                                <div class="row mb-3">
                                                    <div class="col-md-12 d-flex">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="checkAll" onClick="mark_all()">
                                                                <label class="custom-control-label" for="checkAll">Check All</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group ml-3">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="uncheckAll" onClick="unmark_all()">
                                                                <label class="custom-control-label" for="uncheckAll">Uncheck All</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    @foreach ($permissionLabel as $label)
                                                        <div class="col-md-12">
                                                            <h4 class="text-uppercase">- {{$label}}</h4><br>
                                                        </div>

                                                        @foreach ($permission as $value)
                                                            @if (str_contains($value->name, $label))
                                                                <div class="col-md-3 mb-5">
                                                                    <div class="form-group">
                                                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                            <input class="custom-control-input" type="checkbox"
                                                                                id="md_checkbox_<?php echo $value->id; ?>"
                                                                                value="{{ $value->id }}"
                                                                                name="permission[]"
                                                                                {{ isset($rolePermissions) && isset($data) ? in_array($value->id, $rolePermissions) ? 'Checked' : '' : '' }}>
                                                                            <label class="custom-control-label" for="md_checkbox_<?php echo $value->id; ?>">{{ $value->name }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <div class="button-items mt-2 text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script>
        function mark_all() {
            $(':checkbox').each(function() {
                if($(this).attr('id') == "uncheckAll") {
                    this.checked = false;
                }
                else {
                    this.checked = true;
                }

            });
        }

        function unmark_all() {
            $(':checkbox').each(function() {
                if($(this).attr('id') == "uncheckAll") {
                    this.checked = true;
                }
                else {
                    this.checked = false;
                }
            });
        }
        //Submit Form
        $("#role_form").validate({
            errorElement: 'span',
            rules: {
                name: {
                    required: true,
                    maxlength: 40,
                },
                community: {
                    required: true,
                },
            },
            messages: {},
            submitHandler: function(form) {
                var permission = [];
                $('input[name="permission[]"]').each(function() {
                    if(this.checked == true) {
                        permission.push(1);
                    }
                });

                if(permission.length == 0) {
                    somethingWentWrongSweetAlert("You must assign at least 1 permission");
                }
                else {
                    $('#processing-spinner').show();
                    var form_id = "role_form";
                    var form_data = getAllFieldsInFormDataFormat(form_id);
                    form_data.append("id", $("#id").val());

                    axios.post(
                        "{{ url('roles/store') }}",
                        form_data
                    ).then(function(response) {
                        const obj = response.data;
                        if (obj.success == true) {
                            $('#processing-spinner').hide();
                            successSweetAlert(obj.message);
                            $("#id").val(obj.data.id);
                            setTimeout(function() {
                                window.location.href = "{{ url('roles') }}"
                            }, 1000);
                        } else {
                            $('#processing-spinner').hide();
                            somethingWentWrongSweetAlert(obj.message);
                            $('#processing-spinner').hide();
                        }
                    }).catch(function(error) {
                        $('#processing-spinner').hide();
                        console.log(error);
                        somethingWentWrongSweetAlert(JSON.stringify(error.response.data.errors));
                    });
                }
            }
        });
    </script>
@endpush
