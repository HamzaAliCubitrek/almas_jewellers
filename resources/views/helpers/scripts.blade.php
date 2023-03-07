<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>

<!-- jQuery -->
{{-- <script src="{{asset('assets/js/jquery.min.js')}}"></script> --}}

<!-- Axios  -->
<script src="{{ asset('assets/plugins/axios/dist/axios.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('viewly_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- overlayScrollbars -->
<script src="{{ asset('viewly_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('viewly_assets/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('viewly_assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('viewly_assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('viewly_assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('viewly_assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

<!-- SweetAlert2 js -->
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('viewly_assets/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('viewly_assets/dist/js/demo.js') }}"></script>

<script src="{{ asset('viewly_assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

<!-- DatePicker -->
<script src="{{ asset('assets/plugins/datepicker/datepicker.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- Select 2 -->
<script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>

{{-- <script src="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"></script> --}}
<!-- Masking -->
<script src="{{ asset('assets/plugins/imask/imask.js') }}"></script>

<!-- Tinymce -->
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<!-- Summer Note -->
<script src="{{ asset('viewly_assets/plugins/summernote/summernote-bs4.min.js') }}" referrerpolicy="origin"></script>

<!-- CodeMirror -->
<script src="{{ asset('viewly_assets/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('viewly_assets/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('viewly_assets/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('viewly_assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

<script src="{{ asset('js/functions.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script> --}}

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
{{--
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<!-- Function js -->

{{-- <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{asset('viewly_assets/dist/js/pages/dashboard2.js')}}"></script> --}}
@stack('page-scripts')
