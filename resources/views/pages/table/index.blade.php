@extends('layout.master')
@section('styles')
    <link href="{{asset('assets/DataTables/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('main-content')
    <div class="mx-20">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Individu</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <table class="inputs">
                                <tbody>
                                    <tr>
                                        <td>Batch Number:</td>
                                        <td>
                                            <select class="form-select" name="bn-filter" id="bn-filter">
                                                <option value="bn001">bn001</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                        <th class="text-start min-w-50px px-4">id</th>
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
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Kelompok</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <table class="table table-striped table-bordered table-hover" id="weigher-table-kelompok">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                        <th class="text-start text-start min-w-50px px-4">id</th>
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
                                        <th class="text-start">bn</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Summary</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <table class="table table-striped table-bordered table-hover" id="weigher-table-summary">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                        <th class="text-start text-start min-w-50px px-4">id</th>
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
    </script>
@endsection