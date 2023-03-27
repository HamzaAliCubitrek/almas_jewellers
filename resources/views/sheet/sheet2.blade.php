@extends('layouts.app')
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


<style>
    .form-control {
        height: 38px !important;
    }

    hr {
        background: black !important;
        width: 100% !important;
    }

    .text-red {
        color: red;
        font-weight: 900;

    }

    td {
        border: 1px solid #000;
        text-align: center !important;
        font-weight: 900;
        padding: 5px;

    }

    .card-body {
        flex: 0 1 auto;
        padding: 0rem 1rem;
    }

    .table_size {
        max-width: 900px;
    }

    h3,
    h5 {
        /* font-weight: 200 !important; */
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
        @csrf

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





            {{-- table Start --}}


            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <table border="1" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <span>Opening</span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td style="width: 261px;">
                                            <span>Live Rates</span>
                                        </td>
                                    </tr>
                                    {{-- {{ @print_r($data['categories']) }} --}}




                                    <tr>
                                        <td>
                                            <span>Market</span>
                                        </td>
                                        <td>
                                            <span>SELL</span>
                                        </td>
                                        <td>
                                            <span>BUY</span>
                                        </td>
                                        <td>
                                            <span>Last Updated</span>
                                        </td>
                                    </tr>
                                    <?php $i = 0;
                                    $sq = 1;
                                    ?>
                                    @foreach ($data['categories'] as $cate)
                                        <tr>
                                            <td colspan="4">
                                                <h3 class="text-center text-red"> {{ $cate['name'] }}
                                                    <input type="hidden" name="category[]" value="{{ $cate['id'] }}">
                                                </h3>

                                            </td>
                                        </tr>
                                        @if (isset($cate['karats']))
                                            @foreach ($cate['karats'] as $kar)
                                                <tr>
                                                    <td>
                                                        <span>{{ $kar['name'] }}</span>
                                                        <input type="hidden" name="market[{{ $cate['id'] }}][]"
                                                            value="{{ $kar['name'] }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control w-100 sq" type="text"
                                                            onclick="digitValidate(this)"
                                                            id="{{ $kar['name'] }}-{{ $i }}-sell"
                                                            name="sell[{{ $cate['id'] }}][]"
                                                            value="{{ isset($value->sell) ? $value->sell : '' }}">
                                                    </td>
                                                    <td>
                                                        <input class="form-control w-100 sq" type="text"
                                                            onclick="digitValidate(this)"
                                                            id="{{ $kar['name'] }}-{{ $i }}-buy"
                                                            name="buy[{{ $cate['id'] }}][]"
                                                            value="{{ isset($value->buy) ? $value->buy : '' }}">
                                                    </td>
                                                    <td>
                                                        <span><input type="date" name="date[{{ $cate['id'] }}][]"
                                                                id="DateField" value=""></span>
                                                    </td>
                                                </tr>
                                                {{-- {{ print_r($kar) }} --}}
                                                {{-- {{ $kar['name'] }} --}}
                                            @endforeach
                                        @endif
                                        <tr>

                                            <td colspan="4">
                                                <h5 class="text-red"></h5>
                                            </td>
                                        </tr>
                                        @isset($data->rates[0])
                                            @foreach ($data->rates as $rate)
                                                @if ($rate->category_id == $category->id)
                                                    <tr>
                                                        <td>
                                                            <span name="">{{ $rate->market }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-primary">{{ $rate->sell }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-primary">{{ $rate->buy }}</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                {{ date('Y-m-d H:i:s A', strtotime($data->updated_at)) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endisset
                                        <?php $i++;
                                        // $sq++;
                                        ?>
                                    @endforeach

                                    <tr>
                                        <td>
                                            <span>Closing</span>
                                        </td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- table End --}}




                        <div class="col-md-12" id="rates_container"></div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2 mb-5">
                            <a href="{{ url('sheet') }}">
                                <button type="button" class="btn btn-primary bg-danger">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-primary " id="calculate">Calculate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@push('page-scripts')
    <script>
        $(document).ready(function() {
            $("#calculate").click(function() {
                // <?php $sq = 1; ?>

                var elmId = $("#24K-0-sell").val();
                var pertola22k = elmId / 24 * 22;
                var pertola21k = elmId / 24 * 21;
                var pertola18k = elmId / 24 * 18;
                var pertola22k = parseInt(pertola22k);
                var pertola21k = parseInt(pertola21k);
                var pertola18k = parseInt(pertola18k);
                var elmId2 = $("#22K-0-sell").val(pertola22k);
                var elmId2 = $("#21K-0-sell").val(pertola21k);
                var elmId2 = $("#18K-0-sell").val(pertola18k);

                var elmId = $("#24K-0-sell").val();
                var gram24k = elmId / 11.664 * 10;
                var gram22k = pertola22k / 11.664 * 10;
                var gram21k = pertola21k / 11.664 * 10;
                var gram18k = pertola18k / 11.664 * 10;
                var gram24k = parseInt(gram24k);
                var gram22k = parseInt(gram22k);
                var gram21k = parseInt(gram21k);
                var gram18k = parseInt(gram18k);
                var elmId2 = $("#24K-1-sell").val(gram24k);
                var elmId2 = $("#22K-1-sell").val(gram22k);
                var elmId2 = $("#21K-1-sell").val(gram21k);
                var elmId2 = $("#18K-1-sell").val(gram18k);

                var elmId = $("#24K-0-sell").val();
                var onegram24k = elmId / 11.664;
                var onegram22k = pertola22k / 11.664;
                var onegram21k = pertola21k / 11.664;
                var onegram18k = pertola18k / 11.664;
                var onegram24k = parseInt(onegram24k);
                var onegram22k = parseInt(onegram22k);
                var onegram21k = parseInt(onegram21k);
                var onegram18k = parseInt(onegram18k);
                var elmId2 = $("#24K-2-sell").val(onegram24k);
                var elmId2 = $("#22K-2-sell").val(onegram22k);
                var elmId2 = $("#21K-2-sell").val(onegram21k);
                var elmId2 = $("#18K-2-sell").val(onegram18k);

                // buy

                var elmIdbuy = $("#24K-0-buy").val();
                var pertola22kbuy = elmIdbuy / 24 * 22;
                var pertola21kbuy = elmIdbuy / 24 * 21;
                var pertola18kbuy = elmIdbuy / 24 * 18;
                var pertola22kbuy = parseInt(pertola22kbuy);
                var pertola21kbuy = parseInt(pertola21kbuy);
                var pertola18kbuy = parseInt(pertola18kbuy);
                var elmId2 = $("#22K-0-buy").val(pertola22kbuy);
                var elmId2 = $("#21K-0-buy").val(pertola21kbuy);
                var elmId2 = $("#18K-0-buy").val(pertola18kbuy);

                var elmIdbuy = $("#24K-0-buy").val();
                var onegram24kbuy = elmIdbuy / 11.664 * 10;
                var onegram22kbuy = pertola22k / 11.664 * 10;
                var onegram21kbuy = pertola21k / 11.664 * 10;
                var onegram18kbuy = pertola18k / 11.664 * 10;
                var onegram24kbuy = parseInt(onegram24kbuy);
                var onegram22kbuy = parseInt(onegram22kbuy);
                var onegram21kbuy = parseInt(onegram21kbuy);
                var onegram18kbuy = parseInt(onegram18kbuy);
                var elmId2 = $("#24K-1-buy").val(onegram24kbuy);
                var elmId2 = $("#22K-1-buy").val(onegram22kbuy);
                var elmId2 = $("#21K-1-buy").val(onegram21kbuy);
                var elmId2 = $("#18K-1-buy").val(onegram18kbuy);

                var elmId = $("#24K-0-buy").val();
                var gram24kbuy = elmId / 11.664;
                var gram22kbuy = pertola22kbuy / 11.664;
                var gram21kbuy = pertola21kbuy / 11.664;
                var gram18kbuy = pertola18kbuy / 11.664;
                var gram24kbuy = parseInt(onegram24kbuy);
                var gram22kbuy = parseInt(onegram22kbuy);
                var gram21kbuy = parseInt(onegram21kbuy);
                var gram18kbuy = parseInt(onegram18kbuy);
                var elmId2 = $("#24K-2-buy").val(gram24kbuy);
                var elmId2 = $("#22K-2-buy").val(gram22kbuy);
                var elmId2 = $("#21K-2-buy").val(gram21kbuy);
                var elmId2 = $("#18K-2-buy").val(gram18kbuy);


                // var sq = 1;
                // $('td').each(function() {
                //     sq++;
                //     // console.log($(this).text("asd"));
                //     // var a = '<?php $sq++; ?>;'

                //     var valued = $(".sq").val()
                //     var total = $(".sq").val(elmId2);
                //     console.log(a);
                //     // alert(sq
                //     // )
                // })

            });
        });
        document.getElementById('DateField').valueAsDate = new Date();
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
                //console.log('a');
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
