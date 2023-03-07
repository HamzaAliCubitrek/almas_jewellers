@extends('layouts.app')

@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Item</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    <a class="btn btn-info" href="{{ url('items') }}"> Back</a>
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
                    <strong>Production Date:</strong>
                    <input class="form-control" type="date" id="production_date" name="production_date"
                        value="@isset($data->production_date) {{ $data->production_date }} @endisset">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>
                    <input class="form-control" type="text" id="code" name="code"
                        value="@isset($data->code) {{ $data->code }} @endisset">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Weight:</strong>
                    <input class="form-control" type="text" id="weight" name="weight"
                        value="@isset($data->weight) {{ $data->weight }} @endisset">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Client:</strong>
                    <input class="form-control" type="text" id="client" name="client"
                        value="@isset($data->client) {{ $data->client }} @endisset">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Karat:</strong>
                    <input class="form-control" type="text" id="karat" name="karat" placeholder="e.g: 24k"
                        value="@isset($data->karat) {{ $data->karat }} @endisset">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Purity:</strong>
                    <input class="form-control" type="text" id="purity" name="purity"
                        value="@isset($data->purity) {{ $data->purity }} @endisset">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantity:</strong>
                    <input class="form-control" type="text" id="quantity" name="quantity"
                        value="@isset($data->quantity){{$data->quantity}}@endisset">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Origin:</strong>
                    <input class="form-control" type="text" id="origin" name="origin"
                        value="@isset($data->origin) {{ $data->origin }} @endisset">
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
                karat: {
                    required: true,
                    maxlength: 60,
                },
                purity: {
                    required: true,
                    maxlength: 60,
                },
                quantity: {
                    required: true,
                    maxlength: 6,
                    digits: true,
                },
                status: {
                    required: true,
                    maxlength: 60,
                },
                production_date: {
                    required: true,
                },
                Code: {
                    required: true,
                    maxlength: 10,
                },
                weight: {
                    required: true,
                    maxlength: 10,
                },
                origin: {
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
                    "{{ url('items/store') }}",
                    form_data
                ).then(function(response) {
                    const obj = response.data;
                    if (obj.success == true) {
                        $('#processing-spinner').hide();
                        successSweetAlert(obj.message);
                        $("#id").val(obj.data.id);
                        setTimeout(function() {
                            window.location.href = "{{ url('items') }}"
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
