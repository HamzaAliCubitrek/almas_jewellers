<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .form-control {
            height: 38px !important;
        }

        hr {
            background: black !important;
            width: 100% !important;
        }
    </style>

</head>

<body>

    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5 text-center">
                <div class="col-sm-12">
                    <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/AdminLTELogo.png') }}">
                </div>




            </div>
        </div>
    </section>
    <div class="container">


        <form action="{{ url('items/verify') }}" id="" method="POST">
            @csrf

            <input type="hidden" name="id" id="id" value="{{ isset($data->id) ? $data->id : '' }}">
            <div class="row">




                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-header">
                            <h4>Enter Product Code</h4>
                        </div>
                        <?php
                        if(isset($messge)){

                            ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $messge;
                            ?>
                        </div>
                        <?php
                            
                        }
                        ?>

                        <div class="card-body">


                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                    <div class="form-group">
                                        <strong></strong>
                                        <input class="form-control w-100" type="hidden" id="market" name="">
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                    <div class="form-group">
                                        <strong>Code:</strong>
                                        <input class="form-control w-100" type="text" id="market" name="code">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                                    <div class="form-group">
                                        <strong></strong>
                                        <input class="form-control w-100" type="hidden" id="market" name="">
                                    </div>
                                </div>

                            </div>




                        </div>
                    </div>


                </div>
            </div>






    </div>
    </div>



    <div class="col-md-12" id="rates_container"></div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-left mt-2 mb-5 text-center">
        <a href="{{ url('sheet') }}">
            <button type="button" class="btn btn-primary bg-danger">Cancel</button>
        </a>
        <button type="submit" class="btn btn-primary text-center">Submit</button>
    </div>
    </div>
    </form>
    </div>



</body>


</html>
