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
    <link rel="stylesheet" href="{{asset("assets/css/inter_font_api.css") }}" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset("assets/plugins/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
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
                                @if (route('v1.dashboard') != url()->current())
                                    <a href="{{ route('v1.dashboard') }}" class="btn btn-light-danger">Back</a>
                                @endif
                                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                                    <!--begin::Menu wrapper-->
                                    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <img src="/assets/media/avatars/blank.png" class="rounded-3" alt="user" />
                                    </div>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-325px"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="/assets/media/avatars/blank.png" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="row">    
                                                        <div class="col-12">
                                                            <span class="fw-bold fs-5">{{auth()->user()->fullname}}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="badge badge-light-success">{{ auth()->user()->jobTitle }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="{{route('logout')}}" class="menu-link px-5">Sign Out</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::User account menu-->
                                    <!--end::Menu wrapper-->
                                </div>
                                {{-- <a href="../../demo1/dist/authentication/layouts/corporate/sign-in.html" class="btn btn-success">Sign In</a> --}}
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
            </div>
            <!--end::Wrapper-->
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
    <script src="{{ asset('assets/js/check.js') }}"></script>
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
    @yield('scripts')
    @include('layout.alert')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>