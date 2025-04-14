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
                            <h4>Group Data - BN: <span id="bn-display"></span></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="d-flex align-items-center flex-equal">
                                <label for="filter-bn" class="form-label">Filter by BN:</label>
                                <select class="form-select" name="bn-filter" id="bn-filter" >
                                </select>
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
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position">
                                                        <i class="ki-duotone ki-information fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Select-->
                                                <select name="bn-filter" id="ipc-flag-select-awal" data-control="select2" data-placeholder="pilih BN"
                                                    class="form-select form-select">
                                                    <option value="">loading...</option>
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                            <div class="card-content">
                                                <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-awal">
                                                    <thead>
                                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                            <th class="text-start min-w-30px px-2"></th>
                                                            <th class="text-start">DateTime</th>
                                                            {{-- <th class="text-start">no</th> --}}
                                                            <th class="text-start">weight</th>
                                                        </tr>
                                                    </thead>
                                                </table>
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
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position">
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
                                            <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-tengah">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th class="text-start min-w-30px px-2"></th>
                                                        <th class="text-start">DateTime</th>
                                                        {{-- <th class="text-start">no</th> --}}
                                                        <th class="text-start">weight</th>
                                                    </tr>
                                                </thead>
                                            </table>
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
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position">
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
                                            <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-akhir">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th class="text-start min-w-30px px-2"></th>
                                                        <th class="text-start">DateTime</th>
                                                        {{-- <th class="text-start">no</th> --}}
                                                        <th class="text-start">weight</th>
                                                    </tr>
                                                </thead>
                                            </table>
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
            var bnParam = urlParams.get('bn');

            if (!bnParam) {
                alert('Parameter BN tidak ditemukan');
                window.location.href = "{{ route('v1.dashboard') }}";
                return;
            }

            $('#bn-display').text(bnParam); // Menampilkan BN yang dipilih

            function loadBnOptions() {
                var bnParam = urlParams.get('bn'); // Ambil nilai BN dari URL
                $.ajax({
                    url: '/getBn2',
                    method: 'GET',
                    success: function (data) {
                        $.each(data, function (index, value) {
                            
                            // Create the option element
                            var option = $('<option>', {
                                value: value,
                                text: value
                            });

                            // Check if the value matches bnParam
                            if (value === bnParam) {
                                option.prop('selected', true); // Set the option as selected
                            }

                            // Append the option to the dropdown
                            $('#bn-filter').append(option);
                        });
                    }
                });
            }

            // Load opsi bn saat pertama kali halaman dimuat
            loadBnOptions();

            // Event handler untuk filter
            $('#bn-filter').on('change', function () {
                bnParam = $(this).val(); // Ambil nilai BN dari dropdown
                $('#bn-display').text(bnParam); // Tampilkan BN yang dipilih
                if (bnParam == "" || bnParam == null) {
                    bnParam = All; // Set ke null jika "All Batches" dipilih
                }

                loadIpcFlags(bnParam); // Load IPC flags berdasarkan BN yang dipilih
                tableAwal.ajax.reload(); // Reload DataTable dengan filter baru
                tableTengah.ajax.reload(); // Reload DataTable dengan filter baru
                tableAkhir.ajax.reload(); // Reload DataTable dengan filter baru
            });

            function loadIpcFlags(bn) {
                $.ajax({
                    url: '/getIpc/' + bn,
                    method: 'GET',
                    success: function (response) {
                        const ipcAwal = $('#ipc-flag-select-awal'); // Your select field ID
                        ipcAwal.empty();
                        ipcAwal.append('<option value="">Select IPC Flag</option>');

                        // Populate the select field with unique flags
                        $.each(response.flags, function (index, flag) {
                            ipcAwal.append($('<option>', {
                                value: flag,
                                text: flag
                            }));
                        });

                        const ipcTengah = $('#ipc-flag-select-tengah'); // Your select field ID
                        ipcTengah.empty();
                        ipcTengah.append('<option value="">Select IPC Flag</option>');

                        // Populate the select field with unique flags
                        $.each(response.flags, function (index, flag) {
                            ipcTengah.append($('<option>', {
                                value: flag,
                                text: flag
                            }));
                        });

                        const ipcAkhir = $('#ipc-flag-select-akhir'); // Your select field ID
                        ipcAkhir.empty();
                        ipcAkhir.append('<option value="">Select IPC Flag</option>');

                        // Populate the select field with unique flags
                        $.each(response.flags, function (index, flag) {
                            ipcAkhir.append($('<option>', {
                                value: flag,
                                text: flag
                            }));
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
                } else {
                    $('#weigher-table-individu-awal').hide(); // Hide the table if no flag is selected
                }
            });

            $('#ipc-flag-select-tengah').on('change', function () {
                const selectedFlag = $(this).val();
                if (selectedFlag) {
                    tableTengah.ajax.url('{!! route('data.jsonKelompok') !!}?bn=' + bnParam + '&ipc_flag=' + selectedFlag).load();
                    $('#weigher-table-individu-tengah').show();
                } else {
                    $('#weigher-table-individu-tengah').hide();
                }
            });

            $('#ipc-flag-select-akhir').on('change', function () {
                const selectedFlag = $(this).val();
                if (selectedFlag) {
                    tableAkhir.ajax.url('{!! route('data.jsonKelompok') !!}?bn=' + bnParam + '&ipc_flag=' + selectedFlag).load();
                    $('#weigher-table-individu-akhir').show();
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
                lengthMenu: [10, 25, 50, 100],
                lengthChange: false,
                paging: false,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
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
                        data: 'bn',
                        name: 'bn',
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
                        data: 'no',
                        name: 'no',
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
                lengthMenu: [10, 25, 50, 100],
                lengthChange: false,
                paging: false,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
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
                        data: 'bn',
                        name: 'bn'
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
                        data: 'no',
                        name: 'no',
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
                lengthMenu: [10, 25, 50, 100],
                lengthChange: false,
                paging: false,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
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
                        data: 'bn',
                        name: 'bn'
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
                        data: 'no',
                        name: 'no',
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
        });
    </script>
@endsection