@extends('layout.master')
@section('main-content')
    <!--begin::Wrapper-->
    <div class="pb-20 landing-dark-bg">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Heading-->
            <div class="text-center mt-15 mb-18" id="achievements" data-kt-scroll-offset="{default: 100, lg: 150}">
                <!--begin::Title-->
                <h3 class="fs-2hx text-white fw-bold mb-5 pt-18">Data Timbangan</h3>
                <!--end::Title-->
                <!--begin::Description-->
                <div class="fs-5 text-gray-700 fw-bold">Bolstering all production endeavors with its unwavering expertise,
                    seamlessly managing production dashboards
                    <br />and a myriad of other critical functions, ensuring optimal efficiency and performance
                </div>
                <!--end::Description-->
            </div>
            <!--end::Heading-->
            <div class="d-flex flex-wrap flex-center justify-content-lg-between mx-auto w-xl-900px">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required text-gray-300">BN (Batch Number)</span>
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
                                <select name="bn-filter" id="bn-filter" data-control="select2" data-placeholder="pilih BN"
                                    class="form-select form-select-solid">
                                    <option value="">loading...</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-6">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required text-gray-300">Tanggal</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Your payment statements may very based on selected position">
                                        <i class="ki-duotone ki-information fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <input class="form-control" placeholder="Pick a date" id="kt_datepicker_1" />
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Menu-->
            <div class="d-flex flex-center">
                <!--begin::Items-->
                <div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
                    <!--begin::Item-->
                    <a href="{{ route('v1.table.individual.index') }}">
                        <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                            style="background-image: url('assets/media/svg/misc/octagon.svg')">
                            <!--begin::Symbol-->
                            <i class="ki-duotone ki-file fs-4tx text-white mb-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="mb-0">
                                <!--begin::Label-->
                                <span class="text-gray-600 fw-semibold fs-3 lh-0">Individual Data</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <a href="#" id="group-data-link" data-route="{{ route('v1.table.group') }}">
                        <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                            style="background-image: url('assets/media/svg/misc/octagon.svg')">
                            <!--begin::Symbol-->
                            <i class="ki-duotone ki-some-files fs-4tx text-white mb-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="mb-0">

                                <!--begin::Label-->
                                <span class="text-gray-600 fw-semibold fs-3 lh-0">Group Data</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <a href="{{ route('v1.table.summary') }}">
                        <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                            style="background-image: url('assets/media/svg/misc/octagon.svg')">
                            <!--begin::Symbol-->
                            <i class="ki-duotone ki-questionnaire-tablet fs-4tx text-white mb-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="mb-0">
                                <!--begin::Label-->
                                <span class="text-gray-600 fw-semibold fs-3 lh-0">Summary Data</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </a>
                    <!--end::Item-->
                </div>
                <!--end::Items-->
            </div>
            <!--end::Menu-->
            <div class="fs-2 fw-semibold text-muted text-center mb-3">
                <span class="fs-1 lh-1 text-gray-700"></span>
                <br />
                <span class="text-gray-700 me-1"></span>
                <span class="fs-1 lh-1 text-gray-700"></span>
            </div>
            <div class="fs-2 fw-semibold text-muted text-center">
                <a href="../../demo1/dist/account/security.html" class="link-primary fs-4 fw-bold"></a>
                <span class="fs-4 fw-bold text-gray-600"></span>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Wrapper-->
@endsection

@section('scripts')
    <script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script src="assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
    <script src="assets/js/custom/landing.js"></script>
    <script>
        $("#kt_datepicker_1").flatpickr();

        $(function () {
                function loadBnOptions() {
                    $.ajax({
                        url: '/getBn2',
                        method: 'GET',
                        success: function (data) {
                            $.each(data, function (index, value) {
                                $('#bn-filter').append($('<option>', {
                                    value: value,
                                    text: value
                                }));
                            });
                        }
                    });
                }

                // Handle Group Data link click
                $('#group-data-link').on('click', function (e) {
                    e.preventDefault();
                    const selectedBn = $('#bn-filter').val();
                    const baseRoute = $(this).data('route');

                    if (selectedBn) {
                        window.location.href = baseRoute + '?bn=' + encodeURIComponent(selectedBn);
                    } else {
                        alert('Silakan pilih BN terlebih dahulu');
                        // Atau bisa juga redirect tanpa filter
                        // window.location.href = baseRoute;
                    }
                });
                // Load opsi bn saat pertama kali halaman dimuat
                loadBnOptions();
            });
    </script>
@endsection