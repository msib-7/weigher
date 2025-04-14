<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo_only.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="{{asset("assets/css/fonts-googleapis.css") }}" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @yield('styles')
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset("assets/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root" style="background-color: white">
        <!--begin::Header Section-->
        <div class="mb-5" id="home">
            <!--begin::Wrapper-->
            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" 
            {{-- style="background-image: url(assets/media/svg/illustrations/landing.svg)" --}}
                style="background-color: white;">
                <!--begin::Header-->
                <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
                    data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center justify-content-between">
                            <!--begin::Logo-->
                            <div class="d-flex align-items-center flex-equal">
                                {{-- <!--begin::Mobile menu toggle-->
                                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                                    id="kt_landing_menu_toggle">
                                    <i class="ki-duotone ki-abstract-14 fs-2hx">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                                <!--end::Mobile menu toggle--> --}}
                                <!--begin::Logo image-->
                                <a href="#">
                                    <img alt="Logo" src="{{asset("assets/logo/kalbe_farma.png")}}"
                                        class="logo-default h-40px h-lg-50px" />
                                    <img alt="Logo" src="{{asset("assets/logo/kalbe_farma.png")}}"
                                        class="logo-sticky h-35px h-lg-45px" />
                                </a>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Logo-->
                            <!--begin::Toolbar-->
                            <div class="flex-equal text-end ms-1">
                                {{-- <a href="../../demo1/dist/authentication/layouts/corporate/sign-in.html" class="btn btn-success">Sign In</a> --}}
                                @if (route('v1.dashboard') != url()->current())
                                    <a href="{{ route('v1.dashboard') }}" class="btn btn-light-danger">Back</a>
                                @endif
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                {{-- <!--begin::Landing hero-->
                <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                    <!--begin::Heading-->
                    <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                        <!--begin::Title-->
                        <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">Build An Outstanding Solutions
                            <br />with
                            <span
                                style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                <span id="kt_landing_hero_text">The Best Theme Ever</span>
                            </span>
                        </h1>
                        <!--end::Title-->
                        <!--begin::Action-->
                        <a href="../../demo1/dist/index.html" class="btn btn-primary">Try Metronic</a>
                        <!--end::Action-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Clients-->
                    <div class="d-flex flex-center flex-wrap position-relative px-5">
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
                            <img src="assets/media/svg/brand-logos/fujifilm.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
                            <img src="assets/media/svg/brand-logos/vodafone.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
                            <img src="assets/media/svg/brand-logos/kpmg.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
                            <img src="assets/media/svg/brand-logos/nasa.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
                            <img src="assets/media/svg/brand-logos/aspnetzero.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                            title="AON - Empower Results">
                            <img src="assets/media/svg/brand-logos/aon.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
                            <img src="assets/media/svg/brand-logos/hp-3.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
                            <img src="assets/media/svg/brand-logos/truman.svg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                    </div>
                    <!--end::Clients-->
                </div>
                <!--end::Landing hero--> --}}
            </div>
            <!--end::Wrapper-->
            {{-- <!--begin::Curve bottom-->
            <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                        fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve bottom--> --}}
        </div>
        <!--end::Header Section-->

        <!--begin::Content Section-->
        <div class="mt-sm-n10">
            @yield('main-content')
            
        </div>
        <!--end::Content Section-->

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-duotone ki-arrow-up">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Scrolltop-->
    </div>
    <!--end::Root-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{asset("/assets/plugins/global/plugins.bundle.js")}}"></script>
    <script src="{{asset("/assets/js/scripts.bundle.js")}}"></script>
    <!--end::Global Javascript Bundle-->
    @yield('scripts')
    <script src="{{ asset('assets/js/check.js') }}"></script>
    @include('layout.alert')
    <script>
        $(document).ready(function () {
            $('.page-loading').fadeIn();
            setTimeout(function () {
                $('.page-loading').fadeOut();
            }, 1500); // Adjust the timeout duration as needed
        });

        function showLoading() {
            $('#page-loading').fadeIn();
        }
        function hideLoading() {
            $('#page-loading').fadeOut();
        }

        $('form').on('submit', function (e) {
            e.preventDefault(); // Mencegah submit form default

            // Disable tombol submit setelah form disubmit
            var $form = $(this);
            $form.find('button[type="submit"]').attr('disabled', true);
            $form.find('button[type="submit"]').text('Loading...');

            // Gunakan FormData untuk menyertakan file
            var formData = new FormData(this);

            // Submit data menggunakan AJAX
            $.ajax({
                type: $form.attr('method'), // Method form POST atau GET
                url: $form.attr('action'), // URL tujuan
                data: formData, // Gunakan FormData
                processData: false, // Jangan memproses data
                contentType: false, // Jangan set content type
                beforeSend: function () {
                    showLoading();
                    $form.find('button[type="submit"]').attr('disabled', true);
                    $form.find('button[type="submit"]').text('Loading...');
                },
                success: function (response) {
                    // Proses selesai, enable kembali tombol
                    $form.find('button[type="submit"]').attr('disabled', false);
                    $form.find('button[type="submit"]').text('Submit');
                    console.log(response);

                    // Opsional: tangani respons dari Laravel
                    if (response.success) {
                        // Menampilkan SweetAlert dengan pesan sukses
                        Swal.fire({
                            title: 'Success :)',
                            text: response.message,
                            icon: 'success',
                            allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                            allowEscapeKey: false, // Tidak bisa ditutup dengan tombol escape
                            timer: 3000, // Timer 3 detik sebelum redirect
                            timerProgressBar: true, // Progress bar di bawah modal
                            didOpen: () => {
                                Swal
                                    .showLoading(); // Menampilkan loading di dalam modal
                            },
                            willClose: () => {
                                // Redirect ke halaman setelah timer selesai
                                window.location.href = response.redirect;
                            }
                        });
                    } else {
                        // Menampilkan SweetAlert dengan pesan error
                        Swal.fire({
                            title: 'Error System',
                            text: response.message,
                            icon: 'error',
                            allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                            allowEscapeKey: false, // Tidak bisa ditutup dengan tombol escape
                        });

                        // Enable kembali tombol submit
                        $form.find('button[type="submit"]').attr('disabled', false).text(
                            'Submit');
                    }
                },
                error: function (xhr) {
                    // Enable kembali tombol submit
                    $form.find('button[type="submit"]').attr('disabled', false).text(
                        'Submit');

                    // Tangani error validasi dari Laravel
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        // Hapus pesan error sebelumnya
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');

                        var
                            firstErrorField; // Variabel untuk menyimpan elemen error pertama

                        // Tampilkan pesan error
                        $.each(errors, function (key, value) {
                            var inputField = $form.find(`[name="${key}"]`);
                            inputField.addClass('is-invalid');
                            inputField.after(
                                `<span class="invalid-feedback" role="alert"><strong>${value[0]}</strong></span>`
                            );

                            // Simpan elemen error pertama
                            if (!firstErrorField) {
                                firstErrorField = inputField;
                            }
                        });

                        // Scroll ke elemen error pertama
                        if (firstErrorField) {
                            $('html, body').animate({
                                scrollTop: firstErrorField.offset().top -
                                    100 // Offset agar tidak terlalu menempel di atas
                            }, 'slow');
                        }
                    } else {
                        alert('Terjadi kesalahan, coba lagi.');
                    }
                },
                complete: function () {
                    hideLoading();
                    $form.find('button[type="submit"]').attr('disabled', false);
                }
            });
        });
    </script>
    
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>