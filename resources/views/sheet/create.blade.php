@extends('layouts.app')

<style>
    .form-control {
        height: 38px !important;
    }

    hr {
        background: black !important;
        width: 100% !important;
    }
</style>

@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Gold Rate Sheet</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    <a class="btn btn-info" href="{{ url('sheet') }}"> Back</a>
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Add Gold Rate Sheet</li>
                        <li class="breadcrumb-item active">Gold Rate Sheet</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <form action="" id="sheet_form">
        <input type="hidden" name="id" id="id" value="{{ isset($data->id) ? $data->id : '' }}">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" type="text" id="name" name="name"
                        value="@isset($data->name) {{ $data->name }} @endisset">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="status" class="form-control select2">
                        <option value="">-- Select Status --</option>
                        @if (count(config('global.sheet_status')) > 0 && !empty(config('global.sheet_status')))
                            @foreach (config('global.sheet_status') as $key => $val)
                                <option value="{{ $key }}" @if (isset($data->status) && $key == $data->status) selected @endif>
                                    {{ $val }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <h3>Add Rates</h3>
            <hr>

            @if (!isset($data->rates[0]))
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add rate details</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Category:</strong>
                                        <select name="category[]" id="category" class="form-control select2 w-100">
                                            <option value="">-- Select Category --</option>
                                            @if (count($categories) > 0)
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Market:</strong>
                                        <input class="form-control w-100" type="text" onclick="digitValidate(this)"
                                            id="market" name="market[]">
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Sell:</strong>
                                        <input class="form-control w-100" type="text" onclick="digitValidate(this)"
                                            id="sell" name="sell[]">
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Buy:</strong>
                                        <input class="form-control w-100" type="text" onclick="digitValidate(this)"
                                            id="buy" name="buy[]">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" onclick="addRate();"
                                class="btn btn-block btn-info btn-outline btn-sm">Add More +</button>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($data->rates as $key => $value)
                    @php
                        $key = $key + 1;
                    @endphp
                    <div class="col-md-12" id="div12_{{ $key }}">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add rate details</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Category:</strong>
                                            <select name="category[]" id="category" class="form-control select2 w-100">
                                                <option value="">-- Select Category --</option>
                                                @if (count($categories) > 0)
                                                    @foreach ($categories as $index => $category)
                                                        <option value="{{ $category->id }}"
                                                            @isset($value->category_id)
                                                            @if ($value->category_id == $category->id)
                                                                {{ 'selected' }}
                                                            @endif
                                                        @endisset>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Market:</strong>
                                            <input class="form-control w-100" type="text" onclick="digitValidate(this)"
                                                id="market" name="market[]"
                                                value="{{ isset($value->market) ? $value->market : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Sell:</strong>
                                            <input class="form-control w-100" type="text" onclick="digitValidate(this)"
                                                id="sell" name="sell[]"
                                                value="{{ isset($value->sell) ? $value->sell : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Buy:</strong>
                                            <input class="form-control w-100" type="text"
                                                onclick="digitValidate(this)" id="buy" name="buy[]"
                                                value="{{ isset($value->buy) ? $value->buy : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                @if ($key == '1')
                                    <button type="button" onclick="addRate();"
                                        class="btn btn-block btn-info btn-outline btn-sm">Add More +</button>
                                @else
                                    <button type="button" class="btn btn-block btn-danger btn-outline btn-sm"
                                        onclick="removeDiv('div12_{{ $key }}')">Remove</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="col-md-12" id="rates_container"></div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2 mb-5">
                <a href="{{ url('sheet') }}">
                    <button type="button" class="btn btn-primary bg-danger">Cancel</button>
                </a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@push('page-scripts')
    <script>
        function addRate() {
            var id = "profile_" + Math.floor(Math.random() * 77) + 1777;
            var tid = "textarea_" + Math.floor(Math.random() * 77) + 1777;
            var html = "";
            var category = @json($categories);

            html += '<div class="col-12" id="' + id + '">';
            html += '<div class="card">';
            html += '<div class="card-header">';
            html += '<h4>Add rate details</h4>';
            html += '</div>';

            html += '<div class="card-body">';
            html += '<div class="row">';
            html += '<div class="col-xs-6 col-sm-6 col-md-6">';
            html += '<div class="form-group">';
            html += '<strong>Category:</strong>';
            html += '<select name="category[]" id="category" class="form-control select2 w-100">';
            html += '<option value="">-- Select Category --</option>';
            for (let i = 0; i < category.length; i++) {
                html += '<option value="' + category[i].id + '">' + category[i].name + '</option>';
            }
            html += '</select>';
            html += '</div>';
            html += '</div>';

            html += '<div class="col-xs-6 col-sm-6 col-md-6">';
            html += '<div class="form-group">';
            html += '<strong>Market:</strong>';
            html += '<input class="form-control w-100" type="text" onclick="digitValidate(this)"';
            html += 'id="market" name="market[]">';
            html += '</div>';
            html += '</div>';

            html += '<div class="col-xs-6 col-sm-6 col-md-6">';
            html += '<div class="form-group">';
            html += '<strong>Sell:</strong>';
            html += '<input class="form-control w-100" type="text" onclick="digitValidate(this)"';
            html += 'id="sell" name="sell[]">';
            html += '</div>';
            html += '</div>';

            html += '<div class="col-xs-6 col-sm-6 col-md-6">';
            html += '<div class="form-group">';
            html += '<strong>Buy:</strong>';
            html += '<input class="form-control w-100" type="text" onclick="digitValidate(this)"';
            html += 'id="buy" name="buy[]">';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            html += '<div class="card-footer">';
            html += '<button type="button" class="btn btn-block btn-danger btn-outline btn-sm" onclick="removeDiv(' + "'" +
                id + "'" +
                ')">Remove</button>';

            html += '</div>';

            html += '</div>';
            html += '</div>';

            $("#rates_container").append(html);
        }

        //Submit Form
        $("#sheet_form").validate({
            errorElement: 'span',
            rules: {
                name: {
                    required: true,
                    maxlength: 60,
                },
                status: {
                    required: true,
                    maxlength: 60,
                },
                "category[]": {
                    required: true,
                    maxlength: 60,
                },
                "market[]": {
                    required: true,
                    maxlength: 11,
                },
                "sell[]": {
                    required: true,
                    maxlength: 11,
                },
                "buy[]": {
                    required: true,
                    maxlength: 11,
                },
            },
            messages: {},
            submitHandler: function(form) {
                $('#processing-spinner').show();
                var form_id = "sheet_form";

                var form_data = getAllFieldsInFormDataFormat(form_id);
                console.log(form_data);
                form_data.append("id", $("#id").val());

                axios.post(
                        "{{ url('sheet/store') }}",
                        form_data
                    ).then(function(response) {
                        const obj = response.data;
                        if (obj.success == true) {
                            $('#processing-spinner').hide();
                            successSweetAlert(obj.message);
                            $("#id").val(obj.data.id);
                            setTimeout(function() {
                                window.location.href = "{{ url('sheet') }}"
                            }, 1000);
                        } else {
                            $('#processing-spinner').hide();
                            somethingWentWrongSweetAlert(obj.message);
                        }
                    })
                    .catch(function(error) {
                        $('#processing-spinner').hide();
                        console.log(error);
                        somethingWentWrongSweetAlert(JSON.stringify(error.response.data.errors));
                    });
            }
        });
    </script>
@endpush
