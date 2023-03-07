<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
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
</head>

<body>


    {{-- @extends('layouts.Goldsheet.app') --}}


    {{-- @section('content') --}}
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <h1 class="breadcrumb-title text-center mt-5">Gold Rate Sheet</h1>
                </div>




            </div>
        </div>
    </section>
    <div class="container table_size">
        <div class="row">


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
                                    <tr>
                                        <td colspan="4">
                                            <h3 class="text-center text-red">{{ $data->name }}</h3>
                                        </td>
                                    </tr>
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td colspan="4">
                                                <h5 class="text-red">{{ $category->name }}</h5>
                                                
                                            </td>
                                        </tr>
                                        @isset($data->rates[0])
                                            @foreach ($data->rates as $rate)
                                                @if ($rate->category_id == $category->id)
                                                    <tr>
                                                        <td>
                                                            <span>{{ $rate->market }}</span>
                                                            
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
</body>

</html>
