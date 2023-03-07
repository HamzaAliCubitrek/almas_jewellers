@extends('layouts.app')

@section('content')
    <section class="content-header p-0">
        <div class="container-fluid p-0">
            <div class="row mb-5">
                <div class="col-sm-8">
                    <h1 class="breadcrumb-title">Gold Rate Sheet</h1>
                </div>

                <div class="col-4 pull-right text-right">
                    {{-- @can('client-create') --}}
                    <a class="btn btn-danger" href="{{ url('sheet/create') }}">
                        <i class="fas fa-plus mr-2"></i>
                        Create
                    </a>
                    {{-- @endcan --}}
                </div>

                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Gold Rate Sheet Listing</li>
                        <li class="breadcrumb-item active">Gold Rate Sheet</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <form method="get">
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form group">
                    <label for="dates">Filter By Dates</label>
                    <input type="text" name="dates" id="dates" placeholder="Filter By Dates"
                        class="form-control w-100" value="{{ app('request')->input('dates') }}" autocomplete="off">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form group">
                    <label for="btn-sub">-</label><br>
                    <a href="{{ url('sheet') }}" id="btn-sub" class="btn btn-info">Reset</a>
                    <button type="submit" id="btn-sub" class="btn btn-danger">Apply Dates</button>
                </div>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover datatable_listing">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Publish Date</th>
                            <th>Update Date</th>
                            <th width="280px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr id="row_{{ $key }}">
                                <td>{{ ++$i }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                    @if ($value->status == 1)
                                        <span class="badge badge-success">Published on live site</span>
                                    @else
                                        <span class="badge badge-danger">In-Active</span>
                                    @endif
                                </td>
                                <td>{{ date('Y-m-d H:i:s A', strtotime($value->created_at)) }}</td>
                                <td>{{ date('Y-m-d H:i:s A', strtotime($value->updated_at)) }}</td>
                                <td>
                                    <ul class="list-inline">

                                        {{-- <li class="list-inline-item">
                                            <a href="{{ url('sheet/edit', $value->id) }}">
                                                <img src="{{ asset('viewly_assets/dist/img/pencil.png') }}" />
                                            </a>
                                        </li> --}}

                                        <li class="list-inline-item">
                                            <a href="{{ url('sheet/show', $value->id) }}">
                                                <img src="{{ asset('viewly_assets/dist/img/eye.png') }}" />
                                            </a>
                                        </li>

                                        @php
                                            $deleteBtn = url('sheet/destroy', $value->id);
                                        @endphp
                                        <li class="list-inline-item">
                                            <a href="#"
                                                onclick="deleteByAxios('row_{{ $key }}', '{{ $deleteBtn }}')">
                                                <img src="{{ asset('viewly_assets/dist/img/trash.png') }}" />
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Publish Date</th>
                            <th>Update Date</th>
                            <th width="280px;">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script>
        $('input[name="dates"]').daterangepicker({
            uiLibrary: 'bootstrap4'
        });

        var old_dates = "{{ app('request')->input('dates') }}";
        if (old_dates == "") {
            $('input[name="dates"]').val(null);
        }

        $(document).ready(function() {
            $('#example thead th').each(function() {
                var title = $(this).text();
                // $(this).append('<br><input type="text" placeholder="' + title +
                //     '"  style="width: 80px"/>');
                $(this).append('<br><input type="text" placeholder="Filter" style="width: 80px"/>');
            });

            var table = $('#example').DataTable({
                lengthChange: false,
                "autoWidth": false,
                buttons: ['copy', 'excel', 'colvis'],
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.header()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
            });

            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
