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
                            <h4>Individual Data Penimbangan</h4>
                        </div>
                        <div class="card-toolbar">
                            <button id="export-pdf-btn" class="btn btn-dark me-2">Export to PDF</button>
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
                                        {{-- <div class="col col-xl-4"> --}}
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
                                                        <select name="bn-filter" id="ipc-flag-select-awal" data-control="select2" class="form-select form-select">
                                                            <option>no data match...</option>
                                                        </select>
                                                        <!--end::Select-->
                                                    </div>
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
                                                        <div class="row">
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
                                                        <select name="bn-filter" id="ipc-flag-select-tengah" data-control="select2"
                                                            class="form-select form-select">
                                                            <option>no data match...</option>
                                                        </select>
                                                        <!--end::Select-->
                                                    </div>
                                                    <!--end::Input group-->
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
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card" id="summary-table-tengah">
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
                                                            <span class="required text-gray-700">IPC Ke- </span>
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
                                                            class="form-select form-select">
                                                            <option>no data match...</option>
                                                        </select>
                                                        <!--end::Select-->
                                                    </div>
                                                    <!--end::Input group-->
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
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card" id="summary-table-akhir">
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
                                        {{-- <div class="col col-xl-8">
                                            <div class="card card-bordered">
                                                <div class="card-body">
                                                    <div id="lineChart1" style="height: 350px;"></div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-1 row-cols-xl-2">
                                                <div class="col">
                                                    <div class="card card-bordered">
                                                        <div class="card-body">
                                                            <h3 class="fw-bold">No. Tablet - Weight</h3>
                                                            <div id="pieChart1" style="height: 350px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card card-bordered">
                                                        <div class="card-body">
                                                            <h3 class="fw-bold">IPC - Total Weight</h3>
                                                            <div id="pieChart2" style="height: 350px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="card card-flush card-bordered">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Min. Weight</h3>
                                                            <div class="card-toolbar">
                                                                <small><i>(in Batch Number)</i></small><br>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <span class="fs-3hx fw-bold text-gray-800 lh-1 ls-n2" id="min_weight_value">0</span>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <span class="fs-3 fw-semibold text-gray-600">IPC: </span>
                                                                    <span class="fs-3 fw-semibold text-gray-800" id="min_weight_ipc">14</span>
                                                                    <br>
                                                                    <span class="fs-3 fw-semibold text-gray-600">No.Tablet: </span>
                                                                    <span class="fs-3 fw-semibold text-gray-800" id="min_weight_tablet">3 </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="card card-flush card-bordered">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Max. Weight</h3>
                                                            <div class="card-toolbar">
                                                                <small><i>(in Batch Number)</i></small><br>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <span class="fs-3hx fw-bold text-gray-800 lh-1 ls-n2" id="max_weight_value">0</span>
                                                            <div class="row mt-2">
                                                                <div class="col">
                                                                    <span class="fs-3 fw-semibold text-gray-600">IPC: </span>
                                                                    <span class="fs-3 fw-semibold text-gray-800" id="max_weight_ipc">14</span>
                                                                    <br>
                                                                    <span class="fs-3 fw-semibold text-gray-600">No.Tablet: </span>
                                                                    <span class="fs-3 fw-semibold text-gray-800" id="max_weight_tablet">3 </span>
                                                                </div>
                                                            </div>
                                                        </div>
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
@endsection

@section('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        var JSON_INDIVIDU_URL = "{{ route('data.jsonIndividu') }}";
        var JSON_INDIVIDU_PRINT_URL = "{{ route('v1.table.individual.print') }}";
    </script>
    <script src="{{asset('assets/js/table/individual.js')}}"></script>
    
    {{-- <script>
        $(document).ready(function () {
            var element = document.getElementById('kt_apexcharts_1');

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-primary');
            var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'Weight',
                    data: [44, 55, 57, 56, 61, 58]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['30%'],
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
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
                fill: {
                    opacity: 1
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
                colors: [baseColor, secondaryColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });
    </script> --}}
@endsection