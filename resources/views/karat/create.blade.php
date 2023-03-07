@extends('layouts.app')

@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Karat</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    <a class="btn btn-info" href="{{ url('Creat Types') }}"> Back</a>
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Add Item</li>
                        <li class="breadcrumb-item active">Item</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <form action="" id="item_form">
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
                    <strong>Categories:</strong>
                    <select name="category" id="category" class="form-control select2 w-100">
                        @if (count($categories) > 0)
                            @foreach ($categories as $key => $category)
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


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input class="form-control" type="text" id="client" name="description"
                            value="@isset($data->description) {{ $data->description }} @endisset">
                    </div>
                </div>







                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <select name="status" id="status" class="form-control select2">
                            <option value="">-- Select Status --</option>
                            @if (count(config('global.group_status')) > 0 && !empty(config('global.group_status')))
                                @foreach (config('global.group_status') as $key => $val)
                                    <option value="{{ $key }}" @if (isset($data->status) && $key == $data->status) selected @endif>
                                        {{ $val }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </form>
@endsection

@push('page-scripts')
    <script>
        //Submit Form
        $("#item_form").validate({
            errorElement: 'span',
            rules: {
                name: {
                    required: true,
                    maxlength: 60,
                },
                client: {
                    required: true,
                    maxlength: 60,
                },

            },
            messages: {},
            submitHandler: function(form) {
                $('#processing-spinner').show();
                var form_id = "item_form";
                var form_data = getAllFieldsInFormDataFormat(form_id);
                form_data.append("id", $("#id").val());

                axios.post(
                        "{{ url('karat/store') }}",
                        form_data
                    ).then(function(response) {
                        const obj = response.data;
                        if (obj.success == true) {
                            $('#processing-spinner').hide();
                            successSweetAlert(obj.message);
                            $("#id").val(obj.data.id);
                            setTimeout(function() {
                                window.location.href = "{{ url('karat') }}"
                            }, 1000);
                        } else {
                            $('#processing-spinner').hide();
                            somethingWentWrongSweetAlert(obj.message);
                            $('#processing-spinner').hide();
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
