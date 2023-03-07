<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', ':: Almas Jewelers ::') }}</title>

    <!-- Call CSS -->
    @include('helpers.styles')

    <!-- Additional CSS -->
    @yield('OptionalCSS')

    <style>
        .error {
            color: #d51c2e !important;
            font-weight: 600 !important;
        }

        .processing-spinner {
            top: 0% !important;
            background-color: #000;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 2000;
            padding-top: 25%;
            opacity: 0.60;
            filter: alpha(opacity=50);
        }

        .c-show-read-more .c-more-text {
            display: none !important;
        }

        .even {
            background-color: #e5e9ef !important;
        }

        .table-responsive::-webkit-scrollbar {
            -webkit-appearance: none;
        }

        .table-responsive::-webkit-scrollbar:vertical {
            width: 12px;
        }

        .table-responsive::-webkit-scrollbar:horizontal {
            height: 12px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #36925c !important;
            border-radius: 10px;
            border: 2px solid #ffffff;
        }

        .table-responsive::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #ffffff;
        }

        .os-scrollbar-handle {
            color: rgb(52, 58, 64) !important;
            background: #d51c2e !important;
            transform: translate(0px, 113.664px) !important;
        }
    </style>

    @push('page-styles')
    @endpush
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img src="{{ asset("viewly_assets/dist/img/splashLogo.png") }}" alt="AdminLTELogo" height="auto" width="50%">
    </div> --}}
    <!-- Processing Spinner -->
    <div class="processing-spinner" id="processing-spinner" style="display: none">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="spinner-border text-success" role="status"
                    style="width: 4rem;margin-left: 0%;height: 4rem;z-index: 20;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <h1 style="margin-left: 0%;color:#ffffff;">Processing...</h1>
            </div>
        </div>
    </div>

    <div class="wrapper">
        @include('layouts.Goldsheet.navbar')
        @include('layouts.Goldsheet.main-sidebar')

        <!-- /.content-wrapper -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">

                    <!-- Response Message -->
                    @if ($message = Session::get('success'))
                        <div class="row mt-2 ml-2 mr-2" id="onload-alert-success">
                            <div class="col-12 bg-white text-dark p-0 alert shadow p-0 mb-5 bg-body rounded alert-dismissible fade show align-middle d-flex"
                                role="alert">
                                <i class="ps-3 pt-1 far fa-check-circle text-success h3"></i>
                                <p style="padding-top: 1.3%;padding-left: 15px;padding-bottom: 0px;margin: 0px;">
                                    {{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="row mt-2 ml-2 mr-2" id="onload-alert-danger">
                            <div class="col-12 bg-white text-dark p-0 alert shadow p-0 mb-5 bg-body rounded alert-dismissible fade show align-middle d-flex"
                                role="alert">
                                <i class="ps-3 pt-1 far fa-times-circle text-danger h3"></i>
                                <p style="padding-top: 1.3%;padding-left: 15px;padding-bottom: 0px;margin: 0px;">
                                    {{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    @endif

                    @yield('content')

                    <!-- Read more modal -->
                    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header rounded-0">
                                    <h5 class="modal-title" id="staticBackdropLabel">Read More</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" style="height: 250px; overflow-y: auto;" id="staticBackdropBody">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('layouts.Goldsheet.footer')
    </div>

    <!-- Call Scripts -->
    @include('helpers.scripts')

    @push('page-scripts')
    @endpush
    <!-- Additional Scripts -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            if ($(".select2").length) {
                $('.select2').select2();
            }

            //Initialize Select2 Elements
            if ($(".select2bs4").length) {
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
            }

            //Init Date Time Picker
            if ($(".date_time_picker").length) {
                intiDateTimePickerPlugin('date_time_picker');
            }
        });

        $(document).ready(function() {
            // $('.datatable_listing').DataTable({
            //     responsive: true
            // });

            if ($(".datatable_listing").length) {
                $(".datatable_listing").DataTable({
                    "responsive": true,
                    "searching": true,
                    // "lengthChange": false,
                    // "autoWidth": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                });
            }

            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });

            if ($(".select-2-multi").length) {
                $(".select-2-multi").selectize({
                    create: false,
                    delimiter: ',',
                    hideSelected: true,
                    plugins: ['remove_button']
                });
            }

            if ($(".select2-multi").length) {
                $(".select2-multi").select2();
            }

            //readmore or less
            convertToReadMore("c-show-read-more");
        });
    </script>

</body>

</html>
