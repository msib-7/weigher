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
                            <h4>Summary</h4>
                        </div>
                    </div>
                    <div class="card-body">
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
            $('#weigher-table-individu').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('data.jsonSummary') !!}', // memanggil route yang menampilkan data json
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
                        search: {
                            placeholder: 'Type search here'
                        }
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
                        var weight = parseFloat(row.weight); // Assuming 'weight' is the column you want to summarize
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
        });
    </script>
@endsection