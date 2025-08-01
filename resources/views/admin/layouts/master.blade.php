<!DOCTYPE html>
<html lang="{{ get_default_language_code() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (isset($page_title) ? __($page_title) : __("Admin")) }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ get_fav($basic_settings) }}" type="image/x-icon">
    <link href="//fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-all.min.css') }}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- line-awesome-icon css -->
    <link rel="stylesheet" href="{{ asset('backend/css/line-awesome.min.css') }}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('backend/css/animate.css') }}">
    <!-- nice select css -->
    <link rel="stylesheet" href="{{ asset('backend/css/nice-select.css') }}">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
    <!-- rte css -->
    <link rel="stylesheet" href="{{ asset('backend/css/rte_theme_default.css') }}">
    <!-- Popup  -->
    <link rel="stylesheet" href="{{ asset('backend/library/popup/magnific-popup.css') }}">
    <!-- Light case   -->
    <link rel="stylesheet" href="{{ asset('backend/css/lightcase.css') }}">

    <!-- Fileholder CSS CDN -->
    <link rel="stylesheet" href="https://appdevs.cloud/cdn/fileholder/v1.0/css/fileholder-style.css" type="text/css" type="text/css">

    <!-- main style css link -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

    <style>
        .fileholder-single-file-view{
            min-width: 130px;
        }
    </style>
    @stack('css')
</head>
<body>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Admin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="page-wrapper">
    <div id="body-overlay" class="body-overlay"></div>
    @include('admin.partials.right-settings')
    @include('admin.partials.side-nav-mini')
    @include('admin.partials.side-nav')
    <div class="main-wrapper">
        <div class="main-body-wrapper">
            <nav class="navbar-wrapper">
                <div class="dashboard-title-part">
                    @yield('page-title')
                    @yield('breadcrumb')
                </div>
            </nav>
            <div class="body-wrapper">
                @yield('content')
            </div>
        </div>
        @include('admin.partials.footer')
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Admin
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

<!-- jquery -->
<script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<!-- smooth scroll js -->
<script src="{{ asset('backend/js/smoothscroll.min.js') }}"></script>
<!-- easypiechart js -->
<script src="{{ asset('backend/js/jquery.easypiechart.js') }}"></script>
<!-- apexcharts js -->
<script src="{{ asset('backend/js/apexcharts.min.js') }}"></script>
<!-- chart js -->
<script src="{{ asset('backend/js/chart.js') }}"></script>
<!-- nice select js -->
<script src="{{ asset('backend/js/jquery.nice-select.js') }}"></script>
<!-- select2 js -->
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<!-- rte js -->
<script src="{{ asset('backend/js/rte.js') }}"></script>
<!-- rte plugins js -->
<script src='{{ asset('backend/js/all_plugins.js') }}'></script>
<!--  Popup -->
<script src="{{ asset('backend/library/popup/jquery.magnific-popup.js') }}"></script>
<!--  ligntcase -->
<script src="{{ asset('backend/js/lightcase.js') }}"></script>
<!--  Rich text Editor JS -->
<script src="{{ asset('backend/js/ckeditor.js') }}"></script>
<!-- main -->
<script src="{{ asset('backend/js/main.js') }}"></script>

@include('admin.partials.notify')
@include('admin.partials.auth-control')
@include('admin.partials.push-notification')

<script>
    var fileHolderAfterLoad = {};
</script>

<script src="https://appdevs.cloud/cdn/fileholder/v1.0/js/fileholder-script.js" type="module"></script>
<script type="module">
    import { fileHolderSettings } from "https://appdevs.cloud/cdn/fileholder/v1.0/js/fileholder-settings.js";
    import { previewFunctions } from "https://appdevs.cloud/cdn/fileholder/v1.0/js/fileholder-script.js";

    var inputFields = document.querySelector(".file-holder");
    fileHolderAfterLoad.previewReInit = function(inputFields){
        previewFunctions.previewReInit(inputFields)
    };

    fileHolderSettings.urls.uploadUrl = "{{ setRoute('fileholder.upload') }}";
    fileHolderSettings.urls.removeUrl = "{{ setRoute('fileholder.remove') }}";

</script>

<script>
    function fileHolderPreviewReInit(selector) {
        var inputField = document.querySelector(selector);
        fileHolderAfterLoad.previewReInit(inputField);
    }
</script>

<script>
    // lightcase
    $(window).on('load', function () {
      $("a[data-rel^=lightcase]").lightcase();
    })
</script>

@stack('script')

</body>
</html>
