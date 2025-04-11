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
                    <a href="{{ route('v1.table.group') }}">
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
@endsection