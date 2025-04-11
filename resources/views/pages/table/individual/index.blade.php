@extends('layout.master')
@section('styles')
    <link href="{{asset('assets/DataTables/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('main-content')
    <div class="mx-20">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3 shadow">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Individual</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="d-flex align-items-center flex-equal">
                                <label for="filter-bn" class="form-label">Filter by BN:</label>
                                <input type="text" id="filter-bn" class="form-control" placeholder="Enter BN">
                            </div>
                            <div class="col-md-4 flex-equal text-end ms-1">
                                <button id="filter-btn" class="btn btn-primary me-2">Filter</button>
                                {{-- <a href="{{route('v1.table.individual.print')}}"> --}}
                                    <button id="export-pdf-btn" class="btn btn-danger me-2">Export to PDF</button>
                                {{-- </a> --}}
                                <button id="print-btn" class="btn btn-secondary">Print</button>
                            </div>
                        </div>
                        <div class="card-content">
                            <table class="table table-striped table-bordered table-hover" style="width:100%"
                                id="weigher-table-individu">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                        <th class="text-start min-w-30px px-2">no</th>
                                        <th class="text-start">id</th>
                                        <th class="text-start">Device</th>
                                        <th class="text-start">Kode Asset</th>
                                        <th class="text-start">DateTime</th>
                                        <th class="text-start">epoc</th>
                                        <th class="text-start">no</th>
                                        <th class="text-start">weight</th>
                                        <th class="text-start">n</th>
                                        <th class="text-start">x</th>
                                        <th class="text-start">s_dev</th>
                                        <th class="text-start">s_rel</th>
                                        <th class="text-start">min</th>
                                        <th class="text-start">max</th>
                                        <th class="text-start">diff</th>
                                        <th class="text-start">sum</th>
                                        <th class="text-start">lot</th>
                                        <th class="text-start">name</th>
                                        <th class="text-start">cnt</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <span class="fs-3 fw-bold">
                                        SUM:
                                    </span>
                                    <p class="fw-semibold fs-2">
                                        <span id="sum-value">0</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <span class="fs-3 fw-bold">
                                        AVG:
                                    </span>
                                    <p class="fw-semibold fs-2">
                                        <span id="avg-value">0</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <span class="fs-3 fw-bold">
                                        MAX:
                                    </span>
                                    <p class="fw-semibold fs-2">
                                        <span id="max-value">0</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card shadow">
                                <div class="card-body">
                                    <span class="fs-3 fw-bold">
                                        MIN:
                                    </span>
                                    <p class="fw-semibold fs-2">
                                        <span id="min-value">0</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>

    <script>
        $(function () {
            var table = $('#weigher-table-individu').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('data.jsonIndividu') !!}',
                lengthMenu: [10, 25, 50, 100],
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'device_name',
                    name: 'device_name'
                },
                {
                    data: 'kode_asset',
                    name: 'kode_asset'
                },
                {
                    data: 'datetime',
                    name: 'datetime'
                },
                {
                    data: 'epoc',
                    name: 'epoc'
                },
                {
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'weight',
                    name: 'weight'
                },
                {
                    data: 'n',
                    name: 'n'
                },
                {
                    data: 'x',
                    name: 'x'
                },
                {
                    data: 's_dev',
                    name: 's_dev'
                },
                {
                    data: 's_rel',
                    name: 's_rel'
                },
                {
                    data: 'min',
                    name: 'min'
                },
                {
                    data: 'max',
                    name: 'max'
                },
                {
                    data: 'diff',
                    name: 'diff'
                },
                {
                    data: 'sum',
                    name: 'sum'
                },
                {
                    data: 'lot',
                    name: 'lot'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'cnt',
                    name: 'cnt'
                }
                ],
                layout: {
                    topEnd: {
                        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5'],
                    },
                    topStart: {

                    },
                    bottomStart: {
                        pageLength: true,
                    },
                    bottom4End: {
                        info: true,
                    }
                },
                drawCallback: function (settings) {
                    var api = this.api();
                    var data = api.rows({ page: 'current' }).data();

                    var sum = 0;
                    var max = -Infinity;
                    var min = Infinity;
                    var count = 0;

                    data.each(function (row) {
                        var weight = parseFloat(row.weight);
                        if (!isNaN(weight)) {
                            sum += weight;
                            count++;
                            if (weight > max) max = weight;
                            if (weight < min) min = weight;
                        }
                    });

                    var avg = count > 0 ? (sum / count).toFixed(2) : 0;

                    // Update the summary values in the HTML
                    $('#sum-value').text(sum.toFixed(2));
                    $('#avg-value').text(avg);
                    $('#max-value').text(max === -Infinity ? 0 : max);
                    $('#min-value').text(min === Infinity ? 0 : min);
                }
            });

            $('#export-pdf-btn').on('click', function (e) {
                e.preventDefault(); // Prevent the default anchor behavior

                // Gather data from the DataTable
                var data = table.rows({ page: 'current' }).data().toArray(); // This should work correctly
                var summary = {
                    sum: parseFloat($('#sum-value').text()),
                    avg: parseFloat($('#avg-value').text()),
                    max: parseFloat($('#max-value').text()),
                    min: parseFloat($('#min-value').text())
                };

                // Send data to the controller
                $.ajax({
                    url: '{{ route('v1.table.individual.print') }}',
                    method: 'POST',
                    data: {
                        data: data,
                        summary: summary,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    }
                });
            });
        });
    </script>
@endsection