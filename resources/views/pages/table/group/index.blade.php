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
                            <h4>Data Penimbangan: Group</h4>
                        </div>
                        <div class="card-toolbar">
                            <button id="export-pdf-btn" class="btn btn-primary me-2">Export to PDF</button>
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
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="text-center">
                                            <h4>PENGENDALIAN CETAK (IPC BOBOT 10 TABLET)</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-2">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-5">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="kt_daterangepicker_1">
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
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2" for="bn-filter">
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
                                                <input type="hidden" name="isAjax" id="isAjax" value="{{ $isAjax }}">
                                                <!--end::Select-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="card">
                                                {{-- <div class="card-header">
                                                    <div class="card-title">
                                                        <div class="text-center">
                                                            <h4>IPC BOBOT INDIVIDU AWAL</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <div class="d-flex align-items-center">
                                                            <label for="custom-page-length-awal" class="form-label me-2">Entries:</label>
                                                            <input type="number" id="custom-page-length-awal" class="form-control" style="width: 80px"
                                                                min="1" value="10">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="card-body">
                                                    {{-- <!--begin::Input group-->
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
                                                        <select name="bn-filter" id="ipc-flag-select-awal" class="form-select form-select">
                                                            <option value="">loading...</option>
                                                        </select>
                                                        <!--end::Select-->
                                                    </div> --}}
                                                    <!--end::Input group-->
                                                    <div class="card-content">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-awal">
                                                                <thead>
                                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                                        <th class="text-start" style="width: 125px;">No.Tablet/Sample</th>
                                                                        <th class="text-start">DateTime</th>
                                                                        <th class="text-start">weight</th>
                                                                        <th class="text-start">ipc</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="card">
                                                {{-- <div class="card-header">
                                                    <div class="card-title">
                                                        <div class="text-center">
                                                            <h4>IPC BOBOT INDIVIDU TENGAH</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <label for="custom-page-length-tengah" class="form-label me-2">Entries:</label>
                                                        <input type="number" id="custom-page-length-tengah" class="form-control" style="width: 80px" min="1"
                                                            value="10">
                                                    </div>
                                                </div> --}}
                                                <div class="card-body">
                                                    {{-- <!--begin::Input group-->
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
                                                        <select name="bn-filter" id="ipc-flag-select-tengah" data-control="select2"
                                                            data-placeholder="pilih BN" class="form-select form-select">
                                                            <option value="">loading...</option>
                                                        </select>
                                                        <!--end::Select-->
                                                    </div>
                                                    <!--end::Input group--> --}}
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-tengah">
                                                            <thead>
                                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                                    <th class="text-start" style="width: 125px;">No.Tablet/Sample</th>
                                                                    <th class="text-start">DateTime</th>
                                                                    <th class="text-start">weight</th>
                                                                    <th class="text-start">ipc</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="card ">
                                                {{-- <div class="card-header">
                                                    <div class="card-title">
                                                        <div class="text-center">
                                                            <h4>IPC BOBOT INDIVIDU AKHIR</h4>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="card-body">
                                                    {{-- <!--begin::Input group-->
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
                                                        <select name="bn-filter" id="ipc-flag-select-akhir" data-control="select2"
                                                            data-placeholder="pilih BN" class="form-select form-select">
                                                            <option value="">loading...</option>
                                                        </select>
                                                        <!--end::Select-->
                                                    </div>
                                                    <!--end::Input group--> --}}
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" style="width:100%" id="weigher-table-individu-akhir">
                                                            <thead>
                                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                                    <th class="text-start" style="width: 125px;">No.Tablet/Sample</th>
                                                                    <th class="text-start">DateTime</th>
                                                                    <th class="text-start">weight</th>
                                                                    <th class="text-start">ipc</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col"></div>
                                        <div class="col">
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
                                        <div class="col"></div>
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
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
        $(function () {
            $("#kt_daterangepicker_1").daterangepicker();
            let bnParam;
            let selectedBn;
            let selectedFlag1, selectedFlag2, selectedFlag3;
            let chart1, chart2, chart3;

            if ({{ $isAjax }} == 'false' || {{ $isAjax }} == false) {
                // Hide the tables initially
                $('#weigher-table-individu-awal').show();
                $('#weigher-table-individu-tengah').show();
                $('#weigher-table-individu-akhir').show();
            } else {
                $('#weigher-table-individu-awal').hide();
                $('#weigher-table-individu-tengah').hide();
                $('#weigher-table-individu-akhir').hide();

            }

            // Event listener untuk memeriksa pilihan
            $('#kt_daterangepicker_1').on('change', function () {
                loadBnOptions();
                // resetSum(); // Reset summary values
            });

            // Event handler untuk filter
            $('#bn-filter').on('change', function () {
                bnParam = $(this).val(); // Ambil nilai BN dari dropdown
                if (bnParam == "" || bnParam == null) {
                    bnParam = All; // Set ke null jika "All Batches" dipilih
                }

                window.location.href = "{{route('data.jsonKelompokBn', ':id')}}".replace(':id', bnParam); // Redirect ke halaman yang sama dengan parameter BN

                // loadIpcFlags(bnParam); // Load IPC flags berdasarkan BN yang dipilih
                // resetSum(); // Reset summary values
            });

            function loadBnOptions() {
                const selectedDate = $("#kt_daterangepicker_1").val();

                $.ajax({
                    url: "/getBn/G",
                    method: "get",
                    data: {
                        date: selectedDate,
                        _token: CSRF_TOKEN,
                    },
                    beforeSend: function () {
                        $("#bn-filter").empty();
                        $("#bn-filter").append(
                            '<option>loading...</option>'
                        );
                    },
                    success: function (data) {
                        if (data.length === 0) {
                            $("#bn-filter").empty(); // Clear previous options
                            $("#bn-filter").append("<option>No Data Match...</option>");
                        } else {
                            setTimeout(function () {
                                $("#bn-filter").empty(); // Clear previous options
                                $("#bn-filter").append(
                                    "<option>Select Batch Number</option>"
                                );
                                $.each(data, function (index, value) {
                                    $("#bn-filter").append(
                                        $("<option>", {
                                            value: value.lot,
                                            text: value.lot,
                                        })
                                    );
                                });
                            }, 2000); // Delay of 500ms before executing
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors here
                        console.error("AJAX Error:", status, error);
                        alert("Terjadi kesalahan saat memuat data. Silakan coba lagi.");
                    },
                });
            }

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

            var tableAwal = $("#weigher-table-individu-awal").DataTable({
                processing: true,
                serverSide: true,
                order: [[0, "asc"]],
                info: false,
                ajax: {
                    url: '{!! route('data.jsonKelompok') !!}',
                    data: function (d) {
                        d.bn = bnParam; // Selalu gunakan BN dari URL
                    },
                },
                columns: [
                    { data: "no" },
                    { data: "datetime" },
                    { data: "weight" },
                    { data: "ipc" },
                ],
            });

            var tableTengah = $("#weigher-table-individu-tengah").DataTable({
                processing: true,
                serverSide: true,
                order: [[0, "asc"]],
                info: false,
                ajax: {
                    url: '{!! route('data.jsonKelompok') !!}',
                    data: function (d) {
                        d.bn = bnParam; // Selalu gunakan BN dari URL
                    },
                },
                columns: [
                    { data: "no" },
                    { data: "datetime" },
                    { data: "weight" },
                    { data: "ipc" },
                ],
            });

            var tableAkhir = $("#weigher-table-individu-akhir").DataTable({
                processing: true,
                serverSide: true,
                order: [[0, "asc"]],
                info: false,
                ajax: {
                    url: '{!! route('data.jsonKelompok') !!}',
                    data: function (d) {
                        d.bn = bnParam; // Selalu gunakan BN dari URL
                    },
                },
                columns: [
                    { data: "no" },
                    { data: "datetime" },
                    { data: "weight" },
                    { data: "ipc" },
                ],
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