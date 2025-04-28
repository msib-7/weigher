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
                            <h4>Nomor BN: <span id="bn-display"></span></h4>
                        </div>
                        <div class="card-toolbar">
                            <button id="export-pdf-btn" class="btn btn-danger me-2">Export to PDF</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- <div class="d-flex align-items-center flex-equal">
                                <label for="filter-bn" class="form-label">Filter by BN:</label>
                                <input id=bn-filter list="bnFilter" class="form-control" placeholder="Search BN...">
                                <datalist id="bnFilter">
                                </datalist>
                            </div> --}}
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="text-center">
                                                    <h4>IPC BOBOT INDIVIDU AWAL</h4>
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
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="ipc-flag-select-awal">
                                                    <span class="required text-gray-700">IPC Ke-</span>
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
                                                <select name="bn-filter" id="ipc-flag-select-awal"
                                                    class="form-select form-select">
                                                    <option value="">loading...</option>
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                            <div class="card-content">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-awal">
                                                        <thead>
                                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                                <th class="text-start" width="35%">No.Tablet/Sample</th>
                                                                <th class="text-start">DateTime</th>
                                                                <th class="text-start">weight</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="text-center">
                                                    <h4>IPC BOBOT INDIVIDU TENGAH</h4>
                                                </div>
                                            </div>
                                            {{-- <div class="card-toolbar">
                                                <label for="custom-page-length-tengah" class="form-label me-2">Entries:</label>
                                                <input type="number" id="custom-page-length-tengah" class="form-control" style="width: 80px" min="1" value="10">
                                            </div> --}}
                                        </div>
                                        <div class="card-body">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="ipc-flag-select-tengah">
                                                    <span class="required text-gray-700">IPC Ke-</span>
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
                                                <select name="bn-filter" id="ipc-flag-select-tengah" data-control="select2" data-placeholder="pilih BN"
                                                    class="form-select form-select">
                                                    <option value="">loading...</option>
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-tengah">
                                                    <thead>
                                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                            <th class="text-start" width="35%">No.Tablet/Sample</th>
                                                            <th class="text-start">DateTime</th>
                                                            <th class="text-start">weight</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
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
                                                                            <span class="n-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                X
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="x-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                S_DEV
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="s_dev-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                S_REL
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="s_rel-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                MIN
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="min-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                MAX
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="max-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                DIFF
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="diff-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                SUM
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="sum-tengah">0</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="text-center">
                                                    <h4>IPC BOBOT INDIVIDU AKHIR</h4>
                                                </div>
                                            </div>
                                            {{-- <div class="card-toolbar">
                                                <label for="custom-page-length-akhir" class="form-label me-2">Entries:</label>
                                                <input type="number" id="custom-page-length-akhir" class="form-control" style="width: 80px" min="1" value="10">
                                            </div> --}}
                                        </div>
                                        <div class="card-body">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="ipc-flag-select-akhir">
                                                    <span class="required text-gray-700">IPC Ke-</span>
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
                                                <select name="bn-filter" id="ipc-flag-select-akhir" data-control="select2" data-placeholder="pilih BN"
                                                    class="form-select form-select">
                                                    <option value="">loading...</option>
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-akhir">
                                                    <thead>
                                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                            <th class="text-start" width="35%">No.Tablet/Sample</th>
                                                            <th class="text-start">DateTime</th>
                                                            <th class="text-start">weight</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
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
                                                                            <span class="n-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                X
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="x-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                S_DEV
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="s_dev-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                S_REL
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="s_rel-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                MIN
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="min-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                MAX
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="max-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                DIFF
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="diff-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="fs-5 fw-bold">
                                                                                SUM
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="sum-akhir">0</span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-10">
                                <div class="col">
                                    <div class="card card-flush ">
                                        <div class="card-body">
                                            <div id="kt_apexcharts_3" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="py-2">
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
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>


    <script>
        $(function () {
            const urlParams = new URLSearchParams(window.location.search);
            let bnParam;
            let selectedBn;
            let selectedFlag1, selectedFlag2, selectedFlag3;
            let chart1, chart2, chart3;

            // Hide the tables initially
            $('#weigher-table-individu-awal').hide();
            $('#weigher-table-individu-tengah').hide();
            $('#weigher-table-individu-akhir').hide();

            // Event handler untuk filter
            $('#bn-filter').on('change', function () {
                bnParam = $(this).val(); // Ambil nilai BN dari dropdown
                $('#bn-display').text(bnParam); // Tampilkan BN yang dipilih
                if (bnParam == "" || bnParam == null) {
                    bnParam = All; // Set ke null jika "All Batches" dipilih
                }

                loadIpcFlags(bnParam); // Load IPC flags berdasarkan BN yang dipilih
                $('#weigher-table-individu-awal').hide();
                $('#weigher-table-individu-tengah').hide();
                $('#weigher-table-individu-akhir').hide();
                tableAwal.ajax.reload(); // Reload DataTable dengan filter baru
                tableTengah.ajax.reload(); // Reload DataTable dengan filter baru
                tableAkhir.ajax.reload(); // Reload DataTable dengan filter baru
            });

            function loadIpcFlags(bn) {
                $.ajax({
                    url: '/getIpc/G/' + bn,
                    method: 'GET',
                    success: function (response) {
                        const selectIds = ['#ipc-flag-select-awal', '#ipc-flag-select-tengah', '#ipc-flag-select-akhir'];

                        selectIds.forEach(function (selectId) {
                            const selectField = $(selectId);
                            selectField.empty();
                            selectField.append('<option value="">Select IPC</option>');

                            // Populate the select field with unique flags, excluding null or empty values
                            response.flags.forEach(function (flag) {
                                if (flag) { // This checks if flag is not null or an empty string
                                    selectField.append($('<option>', {
                                        value: flag,
                                        text: flag
                                    }));
                                }
                            });
                        });
                    },
                    error: function (error) {
                        console.error("Error fetching IPC flags:", error);
                    }
                });
            }
            // Call this function when you need to load IPC flags
            loadIpcFlags(bnParam);

            $('#ipc-flag-select-awal').on('change', function () {
                const selectedFlag = $(this).val();
                if (selectedFlag) {
                    // Load data into the DataTable based on the selected IPC flag
                    tableAwal.ajax.url('{!! route('data.jsonKelompok') !!}?bn=' + bnParam + '&ipc_flag=' + selectedFlag).load();
                    $('#weigher-table-individu-awal').show(); // Show the table
                    $.ajax({
                        url: '/getSummary/' + bnParam + '/' + selectedFlag,
                        method: 'GET',
                        success: function ([dataSum, dataAll]) {
                            if (dataSum.length > 0) {
                                // Update the summary fields with the dataSum received from the server
                                $('.n-awal').text(dataSum[0].n);
                                $('.x-awal').text(dataSum[0].x);
                                $('.s_dev-awal').text(dataSum[0].s_dev);
                                $('.s_rel-awal').text(dataSum[0].s_rel);
                                $('.min-awal').text(dataSum[0].min);
                                $('.max-awal').text(dataSum[0].max);
                                $('.diff-awal').text(dataSum[0].diff);
                                $('.sum-awal').text(dataSum[0].sum);
                            }

                            // Extract 'no' values and format them
                            var categories = dataAll.map(function (row) {
                                return 'Tablet - ' + row.no; // Format as "Tablet - {no}"
                            });
                            var data = dataAll.map(function (row) {
                                return row.weight;
                            });

                            // Update the chart with new categories and data
                            if (chart) {
                                chart.updateOptions({
                                    xaxis: {
                                        categories: categories // Update categories
                                    },
                                    series: [{
                                        name: 'Weight',
                                        data: data // Update data
                                    }]
                                });
                            } else {
                                // If chart is not initialized, create it
                                createChart1(categories, data);
                            }
                        },
                    });
                } else {
                    $('#weigher-table-individu-awal').hide(); // Hide the table if no flag is selected
                }
            });

            $('#ipc-flag-select-tengah').on('change', function () {
                const selectedFlag = $(this).val();
                if (selectedFlag) {
                    tableTengah.ajax.url('{!! route('data.jsonKelompok') !!}?bn=' + bnParam + '&ipc_flag=' + selectedFlag).load();
                    $('#weigher-table-individu-tengah').show();
                    $.ajax({
                        url: '/getSummary/' + bnParam + '/' + selectedFlag,
                        method: 'GET',
                        success: function ([dataSum, dataAll]) {
                            if (dataSum.length > 0) {
                                // Update the summary fields with the dataSum received from the server
                                $('.n-tengah').text(dataSum[0].n);
                                $('.x-tengah').text(dataSum[0].x);
                                $('.s_dev-tengah').text(dataSum[0].s_dev);
                                $('.s_rel-tengah').text(dataSum[0].s_rel);
                                $('.min-tengah').text(dataSum[0].min);
                                $('.max-tengah').text(dataSum[0].max);
                                $('.diff-tengah').text(dataSum[0].diff);
                                $('.sum-tengah').text(dataSum[0].sum);
                            }
                        },
                    });
                } else {
                    $('#weigher-table-individu-tengah').hide();
                }
            });

            $('#ipc-flag-select-akhir').on('change', function () {
                const selectedFlag = $(this).val();
                if (selectedFlag) {
                    tableAkhir.ajax.url('{!! route('data.jsonKelompok') !!}?bn=' + bnParam + '&ipc_flag=' + selectedFlag).load();
                    $('#weigher-table-individu-akhir').show();
                    $.ajax({
                        url: '/getSummary/' + bnParam + '/' + selectedFlag,
                        method: 'GET',
                        success: function ([dataSum, dataAll]) {
                            if (dataSum.length > 0) {
                                // Update the summary fields with the dataSum received from the server
                                $('.n-akhir').text(dataSum[0].n);
                                $('.x-akhir').text(dataSum[0].x);
                                $('.s_dev-akhir').text(dataSum[0].s_dev);
                                $('.s_rel-akhir').text(dataSum[0].s_rel);
                                $('.min-akhir').text(dataSum[0].min);
                                $('.max-akhir').text(dataSum[0].max);
                                $('.diff-akhir').text(dataSum[0].diff);
                                $('.sum-akhir').text(dataSum[0].sum);
                            }
                        },
                    });
                } else {
                    $('#weigher-table-individu-akhir').hide();
                }
            });

            function convertDataToNumbers(data) {
                return data.map(item => {
                    return {
                        n: parseInt(item.n, 10) || 0, // Convert to integer
                        x: parseFloat(item.x) || 0,   // Convert to float
                        s_dev: parseFloat(item.s_dev) || 0,
                        s_rel: parseFloat(item.s_rel) || 0,
                        min: parseFloat(item.min) || 0,
                        max: parseFloat(item.max) || 0,
                        diff: parseFloat(item.diff) || 0,
                        sum: parseFloat(item.sum) || 0,
                        // Add other fields as necessary
                    };
                });
            }

            function calculateMetrics(data) {
                return data.reduce((metrics, item) => {
                    // Ensure that each value is a number before adding
                    metrics.n += (typeof item.n === 'number' ? item.n : 0);
                    metrics.x += (typeof item.x === 'number' ? item.x : 0);
                    metrics.sDev += (typeof item.s_dev === 'number' ? item.s_dev : 0);
                    metrics.sRel += (typeof item.s_rel === 'number' ? item.s_rel : 0);
                    metrics.diff += (typeof item.diff === 'number' ? item.diff : 0);
                    metrics.sum += (typeof item.sum === 'number' ? item.sum : 0);

                    // Update min and max
                    // metrics.min = Math.min(metrics.min, (typeof item.min === 'number' ? item.min : metrics.min));
                    // metrics.max = Math.max(metrics.max, (typeof item.max === 'number' ? item.max : metrics.max));

                    metrics.min += (typeof item.min === 'number' ? item.min : 0);
                    metrics.max += (typeof item.max === 'number' ? item.max : 0);

                    return metrics;
                }, {
                    n: 0,
                    x: 0,
                    sDev: 0,
                    sRel: 0,
                    min: 0, // Initialize to Infinity for min calculation
                    max: 0, // Initialize to -Infinity for max calculation
                    diff: 0,
                    sum: 0
                });
            }

            var tableAwal = $('#weigher-table-individu-awal').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('data.jsonKelompok') !!}',
                    data: function (d) {
                        d.bn = bnParam; // Selalu gunakan BN dari URL
                    }
                },
                columnDefs: [{ width: 200, targets: 1 }],
                lengthMenu: [10, 25, 50, 100],
                lengthChange: false,
                paging: false,
                info: false,
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'DT_RowIndex',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                    data: 'no',
                    name: 'no',
                    },
                    {
                        data: 'datetime',
                        name: 'datetime'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
                    },
                    {
                        data: 'lot',
                        name: 'lot',
                        visible: false
                    },
                    {
                        data: 'device_name',
                        name: 'device_name',
                        visible: false
                    },
                    {
                        data: 'kode_asset',
                        name: 'kode_asset',
                        visible: false
                    },
                    {
                        data: 'epoc',
                        name: 'epoc',
                        visible: false
                    },
                    {
                        data: 'n',
                        name: 'n',
                        visible: false
                    },
                    {
                        data: 'x',
                        name: 'x',
                        visible: false
                    },
                    {
                        data: 's_dev',
                        name: 's_dev',
                        visible: false
                    },
                    {
                        data: 's_rel',
                        name: 's_rel',
                        visible: false
                    },
                    {
                        data: 'min',
                        name: 'min',
                        visible: false
                    },
                    {
                        data: 'max',
                        name: 'max',
                        visible: false
                    },
                    {
                        data: 'diff',
                        name: 'diff',
                        visible: false
                    },
                    {
                        data: 'sum',
                        name: 'sum',
                        visible: false
                    },
                    {
                        data: 'lot',
                        name: 'lot',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        visible: false
                    },
                    {
                        data: 'cnt',
                        name: 'cnt',
                        visible: false
                    }
                ],
                layout: {
                    topEnd: {},
                    topStart: {},
                    bottomStart: {
                        pageLength: true,
                    },
                    bottom4End: {
                        info: true,
                    }
                },
                drawCallback: function (settings) {
                    var api = this.api();
                    var data = api.rows({ page: 'current' }).data(); // Get current page data

                    // Check if data is an array
                    if (data.length > 0) {
                        var convertedData = convertDataToNumbers(data.toArray()); // Convert data to numbers

                        // Calculate metrics using convertedData
                        var metrics = calculateMetrics(convertedData);

                        // Update the summary fields
                        $('.n-awal').text(metrics.n);
                        $('.x-awal').text(metrics.x.toFixed(2));
                        $('.s_dev-awal').text(metrics.sDev.toFixed(2));
                        $('.s_rel-awal').text(metrics.sRel.toFixed(2));
                        $('.min-awal').text(metrics.min.toFixed(2));
                        $('.max-awal').text(metrics.max.toFixed(2));
                        $('.diff-awal').text(metrics.diff.toFixed(2));
                        $('.sum-awal').text(metrics.sum.toFixed(2));
                    } else {
                        console.error("No data available for the current page.");
                    }
                }
            });

            var tableTengah = $('#weigher-table-individu-tengah').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('data.jsonKelompok') !!}',
                    data: function (d) {
                        d.bn = bnParam; // Selalu gunakan BN dari URL
                    }
                },
                columnDefs: [{ width: 200, targets: 1 }],
                lengthMenu: [10, 25, 50, 100],
                lengthChange: false,
                paging: false,
                info: false,
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'DT_RowIndex',
                    //     orderable: false,
                    //     searchable: false
                    // },

                    {
                        data: 'no',
                        name: 'no',
                    },
                    {
                        data: 'datetime',
                        name: 'datetime'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
                    },
                    {
                        data: 'lot',
                        name: 'lot',
                        visible: false
                    },
                    {
                        data: 'device_name',
                        name: 'device_name',
                        visible: false
                    },
                    {
                        data: 'kode_asset',
                        name: 'kode_asset',
                        visible: false
                    },
                    {
                        data: 'epoc',
                        name: 'epoc',
                        visible: false
                    },
                    {
                        data: 'n',
                        name: 'n',
                        visible: false
                    },
                    {
                        data: 'x',
                        name: 'x',
                        visible: false
                    },
                    {
                        data: 's_dev',
                        name: 's_dev',
                        visible: false
                    },
                    {
                        data: 's_rel',
                        name: 's_rel',
                        visible: false
                    },
                    {
                        data: 'min',
                        name: 'min',
                        visible: false
                    },
                    {
                        data: 'max',
                        name: 'max',
                        visible: false
                    },
                    {
                        data: 'diff',
                        name: 'diff',
                        visible: false
                    },
                    {
                        data: 'sum',
                        name: 'sum',
                        visible: false
                    },
                    {
                        data: 'lot',
                        name: 'lot',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        visible: false
                    },
                    {
                        data: 'cnt',
                        name: 'cnt',
                        visible: false
                    }
                ],
                layout: {
                    topEnd: {},
                    topStart: {},
                    bottomStart: {
                        pageLength: true,
                    },
                    bottom4End: {
                        info: true,
                    }
                },
                drawCallback: function (settings) {
                    var api = this.api();
                    var data = api.rows({ page: 'current' }).data(); // Get current page data

                    // Check if data is an array
                    if (data.length > 0) {
                        var convertedData = convertDataToNumbers(data.toArray()); // Convert data to numbers

                        // Calculate metrics using convertedData
                        var metrics = calculateMetrics(convertedData);

                        // Update the summary fields
                        $('.n-tengah').text(metrics.n);
                        $('.x-tengah').text(metrics.x.toFixed(2));
                        $('.s_dev-tengah').text(metrics.sDev.toFixed(2));
                        $('.s_rel-tengah').text(metrics.sRel.toFixed(2));
                        $('.min-tengah').text(metrics.min.toFixed(2));
                        $('.max-tengah').text(metrics.max.toFixed(2));
                        $('.diff-tengah').text(metrics.diff.toFixed(2));
                        $('.sum-tengah').text(metrics.sum.toFixed(2));
                    } else {
                        console.error("No data available for the current page.");
                    }
                }
            });

            var tableAkhir = $('#weigher-table-individu-akhir').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('data.jsonKelompok') !!}',
                    data: function (d) {
                        d.bn = bnParam; // Selalu gunakan BN dari URL
                    }
                },
                columnDefs: [{ width: 200, targets: 1 }],
                lengthMenu: [10, 25, 50, 100],
                lengthChange: false,
                paging: false,
                info: false,
                columns: [
                    // {
                    //     data: 'DT_RowIndex',
                    //     name: 'DT_RowIndex',
                    //     orderable: false,
                    //     searchable: false
                    // },

                    {
                        data: 'no',
                        name: 'no',
                    },
                    {
                        data: 'datetime',
                        name: 'datetime'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
                    },
                    {
                        data: 'lot',
                        name: 'lot',
                        visible: false
                    },
                    {
                        data: 'device_name',
                        name: 'device_name',
                        visible: false
                    },
                    {
                        data: 'kode_asset',
                        name: 'kode_asset',
                        visible: false
                    },
                    {
                        data: 'epoc',
                        name: 'epoc',
                        visible: false
                    },
                    {
                        data: 'n',
                        name: 'n',
                        visible: false
                    },
                    {
                        data: 'x',
                        name: 'x',
                        visible: false
                    },
                    {
                        data: 's_dev',
                        name: 's_dev',
                        visible: false
                    },
                    {
                        data: 's_rel',
                        name: 's_rel',
                        visible: false
                    },
                    {
                        data: 'min',
                        name: 'min',
                        visible: false
                    },
                    {
                        data: 'max',
                        name: 'max',
                        visible: false
                    },
                    {
                        data: 'diff',
                        name: 'diff',
                        visible: false
                    },
                    {
                        data: 'sum',
                        name: 'sum',
                        visible: false
                    },
                    {
                        data: 'lot',
                        name: 'lot',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        visible: false
                    },
                    {
                        data: 'cnt',
                        name: 'cnt',
                        visible: false
                    }
                ],
                layout: {
                    topEnd: {},
                    topStart: {},
                    bottomStart: {
                        pageLength: true,
                    },
                    bottom4End: {
                        info: true,
                    }
                },
                drawCallback: function (settings) {
                    var api = this.api();
                    var data = api.rows({ page: 'current' }).data(); // Get current page data

                    // Check if data is an array
                    if (data.length > 0) {
                        var convertedData = convertDataToNumbers(data.toArray()); // Convert data to numbers

                        // Calculate metrics using convertedData
                        var metrics = calculateMetrics(convertedData);

                        // Update the summary fields
                        $('.n-akhir').text(metrics.n);
                        $('.x-akhir').text(metrics.x.toFixed(2));
                        $('.s_dev-akhir').text(metrics.sDev.toFixed(2));
                        $('.s_rel-akhir').text(metrics.sRel.toFixed(2));
                        $('.min-akhir').text(metrics.min.toFixed(2));
                        $('.max-akhir').text(metrics.max.toFixed(2));
                        $('.diff-akhir').text(metrics.diff.toFixed(2));
                        $('.sum-akhir').text(metrics.sum.toFixed(2));
                    } else {
                        console.error("No data available for the current page.");
                    }
                }
            });

            $('#export-pdf-btn').on('click', function (e) {
                var bnParam = $('#bn-display').text();
                e.preventDefault(); // Prevent the default anchor behavior

                // Check if any of the tables are hidden
                var isAwalVisible = $('#weigher-table-individu-awal').is(':visible');
                var isTengahVisible = $('#weigher-table-individu-tengah').is(':visible');
                var isAkhirVisible = $('#weigher-table-individu-akhir').is(':visible');

                // // If any table is hidden, show an alert and return

                // Gather data from all DataTables
                var dataAwal = isAwalVisible ? tableAwal.rows().data().toArray() : [];
                var dataTengah = isTengahVisible ? tableTengah.rows().data().toArray() : [];
                var dataAkhir = isAkhirVisible ? tableAkhir.rows().data().toArray() : [];

                var data = {
                    awal: dataAwal,
                    tengah: dataTengah,
                    akhir: dataAkhir
                };

                var summaryAwal = {
                    n: parseFloat($('.n-awal').text()),
                    x: parseFloat($('.x-awal').text()),
                    s_dev: parseFloat($('.s_dev-awal').text()),
                    s_rel: parseFloat($('.s_rel-awal').text()),
                    min: parseFloat($('.min-awal').text()),
                    max: parseFloat($('.max-awal').text()),
                    diff: parseFloat($('.diff-awal').text()),
                    sum: parseFloat($('.sum-awal').text()),
                };

                var summaryTengah = {
                    n: parseFloat($('.n-tengah').text()),
                    x: parseFloat($('.x-tengah').text()),
                    s_dev: parseFloat($('.s_dev-tengah').text()),
                    s_rel: parseFloat($('.s_rel-tengah').text()),
                    min: parseFloat($('.min-tengah').text()),
                    max: parseFloat($('.max-tengah').text()),
                    diff: parseFloat($('.diff-tengah').text()),
                    sum: parseFloat($('.sum-tengah').text()),
                };

                var summaryAkhir = {
                    n: parseFloat($('.n-akhir').text()),
                    x: parseFloat($('.x-akhir').text()),
                    s_dev: parseFloat($('.s_dev-akhir').text()),
                    s_rel: parseFloat($('.s_rel-akhir').text()),
                    min: parseFloat($('.min-akhir').text()),
                    max: parseFloat($('.max-akhir').text()),
                    diff: parseFloat($('.diff-akhir').text()),
                    sum: parseFloat($('.sum-akhir').text()),
                };

                var summary = {
                    awal: summaryAwal,
                    tengah: summaryTengah,
                    akhir: summaryAkhir
                };

                // Send data to the controller
                $.ajax({
                    url: '{{ route('v1.table.group.print') }}',
                    method: 'POST',
                    data: {
                        data: data,
                        summary: summary,
                        bn: bnParam,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    }
                });
            });

            // Function to create the chart
            function createChart1(categories, data) {
                var element = document.getElementById('kt_apexcharts_3');

                var height = parseInt(KTUtil.css(element, 'height'));
                var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                var baseColor = KTUtil.getCssVariableValue('--bs-info');
                var lightColor = KTUtil.getCssVariableValue('--bs-info-light');

                if (!element) {
                    return;
                }

                var options = {
                    series: [{
                        name: 'Weight',
                        data: data // Initial data
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {

                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [baseColor]
                    },
                    xaxis: {
                        categories: categories,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: baseColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function (val) {
                                return val
                            }
                        }
                    },
                    colors: [lightColor],
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        strokeColor: baseColor,
                        strokeWidth: 3
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            }

        });
    </script>
@endsection