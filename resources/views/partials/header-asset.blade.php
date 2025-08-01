<!-- favicon -->
<link rel="shortcut icon" href="{{ get_fav($basic_settings) }}" type="image/x-icon">
<!-- fontawesome css link -->
<link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.css') }}">
<!-- bootstrap css link -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
<!-- swipper css link -->
<link rel="stylesheet" href="{{ asset('frontend/css/swiper.css') }}">
<!-- lightcase css links -->
<link rel="stylesheet" href="{{ asset('frontend/css/lightcase.css') }}">
<!-- AOS css link -->
<link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
<!-- odometer css link -->
<link rel="stylesheet" href="{{ asset('frontend/css/odometer.css') }}">
<!-- line-awesome-icon css -->
<link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.css') }}">
<!-- animate.css -->
<link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
<!-- nice select css -->
<link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
<!-- Popup  -->
<link rel="stylesheet" href="{{ asset('backend/library/popup/magnific-popup.css') }}">
<!-- Select 2 CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/select2.css') }}">
<!-- file holder css -->
<link rel="stylesheet" href="https://appdevs.cloud/cdn/fileholder/v1.0/css/fileholder-style.css" type="text/css">
<!-- main style css link -->
<link rel="stylesheet" href="{{ asset('frontend/css/style.css?v=2') }}">

@php
$color = '#7606aaff';
//$color = '@$basic_settings->base_color' ?? '#000000'; 

$secondaryColor =  '#ffffffff';

@endphp

<style>
:root {
--primary-color: {{$color}};
--secondary-color: {{$secondaryColor}};
}

</style>