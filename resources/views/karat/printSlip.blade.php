<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('css/print.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Receipt example</title>
</head>

<body>
    <div class="ticket">
        <div class="text-center">
            <img class="nav-icon" src="{{ asset('viewly_assets/dist/img/AdminLTELogo.png') }}">
        </div>
        <h1 class="centered">RECEIPT

        </h1>
        <table>
            <thead>
                <tr>
                    <th class="description">Name</th>
                    <th class="description">Client</th>
                    <th class="description">Karat</th>
                    <th class="description">Purity</th>
                    <th class="description">Quantity</th>
                    <!-- <th class="price">$$</th> -->

                </tr>
            </thead>
            <tbody>


                <tr>


                    <td class="description">{{ $item->name }}</td>
                    <td class=" description">{{ $item->client }}</td>
                    <td class="description">{{ $item->karat }}</td>
                    <td class="description">{{ $item->purity }}</td>
                    <td class="description">{{ $item->quantity }}</td>




                </tr>




            </tbody>

        </table>
        <p class="Qr_img"> {!! $item->barcode !!} </p>
        <p class="centered">Thanks for your purchase!
        </p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script src="script.js"></script>

    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>

</body>

</html>
