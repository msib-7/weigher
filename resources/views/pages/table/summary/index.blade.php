@extends('layout.master')
@section('styles')
    <script>var CSRF_TOKEN = "{{ csrf_token() }}";</script>
        <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('main-content')
    <div class="mx-20">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3 shadow">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('v1.dashboard') }}" class="my-5 me-5 rounded-circle btn btn-icon btn-light-danger">
                                <i class="ki-duotone ki-arrow-left fs-2x fw-bold">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <h4>Data Penimbangan: Summary</h4>
                        </div>
                        <div class="card-toolbar">
                            <button id="export-pdf-btn" class="btn btn-primary me-2">Export to PDF</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-12 col-lg-2">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="ipc-flag-select-awal">
                                                    <span class="required text-gray-700">Tanggal: </span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Tanggal">
                                                        <i class="ki-duotone ki-information fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <input class="form-control" placeholder="Pick a date" id="kt_daterangepicker_1" />
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="ipc-flag-select-awal">
                                                    <span class="required text-gray-700">Nomor Batch: </span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Pilih IPC untuk ditampilkan">
                                                        <i class="ki-duotone ki-information fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Select-->
                                                <select name="bn-filter" id="bn-filter" data-control="select2" class="form-select form-select">
                                                    <option>No Data Match...</option>
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <hr class="text-gray-300 mb-5"/>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <div class="text-center">
                                                            <h4>Summary Data</h4>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="card-toolbar">
                                                        <div class="d-flex align-items-center">
                                                            <label for="custom-page-length-awal" class="form-label me-2">Entries:</label>
                                                            <input type="number" id="custom-page-length-awal" class="form-control" style="width: 80px" min="1" value="10">
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <div class="card-body">
                                                    <div class="card-content">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-awal">
                                                                <thead>
                                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                                        <th class="text-start">No</th>
                                                                        <th class="text-start">DateTime</th>
                                                                        {{-- <th class="text-start">weight</th> --}}
                                                                        <th class="text-start">n</th>
                                                                        <th class="text-start">x</th>
                                                                        <th class="text-start">s_dev</th>
                                                                        <th class="text-start">s_rel</th>
                                                                        <th class="text-start">min</th>
                                                                        <th class="text-start">max</th>
                                                                        <th class="text-start">diff</th>
                                                                        <th class="text-start">weight sum</th>
                                                                        <th class="text-start">lot/bn</th>
                                                                        <th class="text-start">ipc</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                        {{-- <div class="row">
                                                            <div class="col-12">
                                                                <div class="card" id="summary-table-awal">
                                                                    <div class="card-body">
                                                                        <table class="table table-bordered" style="">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            N
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="n-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            X
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="x-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            S_DEV
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="s_dev-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            S_REL
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="s_rel-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            MIN
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="min-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            MAX
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="max-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            DIFF
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="diff-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <span class="fs-5 fw-bold">
                                                                                            SUM
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="sum-awal">0</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        var JSON_URL = "{{ route('data.jsonSummary') }}";
        // var JSON_INDIVIDU_PRINT_URL = "{{ route('v1.table.individual.print') }}";
    </script>
    <script src="{{asset('assets/js/table/summary.js')}}"></script>
        {{-- <script>
            $(function () {
                $('#weigher-table-individu').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('data.jsonIndividu') !!}', // memanggil route yang menampilkan data json
                    columns: [{ // mengambil & menampilkan kolom sesuai tabel database
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
                        topStart: {
                            buttons: [{
                                extend: 'print',
                                className: "btn btn-light-dark"
                            }],
                        },
                        topEnd: {
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
                    }
                });
            });
            $(function () {
                $('#weigher-table-kelompok').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('data.jsonKelompok') !!}', // memanggil route yang menampilkan data json
                    columns: [{ // mengambil & menampilkan kolom sesuai tabel database
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
                    },
                    {
                        data: 'bn',
                        name: 'bn'
                    }
                    ],
                    layout: {
                        topStart: {
                            buttons: [{
                                extend: 'copy',
                                className: "btn btn-secondary"
                            }, {
                                extend: 'print',
                                className: "btn btn-light-dark"
                            }, {
                                extend: 'collection',
                                className: 'btn btn-light-primary',
                                text: 'Export',
                                buttons: ['csv', 'excel', 'pdf']
                            }],
                        },
                        topEnd: {
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
                    }
                });
            });
            $(function () {
                $('#weigher-table-summary').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('data.jsonSummary') !!}', // memanggil route yang menampilkan data json
                    columns: [{ // mengambil & menampilkan kolom sesuai tabel database
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
                        topStart: {
                            buttons: [{
                                extend: 'copy',
                                className: "btn btn-secondary"
                            }, {
                                extend: 'print',
                                className: "btn btn-light-dark"
                            }, {
                                extend: 'collection',
                                className: 'btn btn-light-primary',
                                text: 'Export',
                                buttons: ['csv', 'excel', 'pdf']
                            }],
                        },
                        topEnd: {
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
                    }
                });
            });
        </script> --}}
@endsection