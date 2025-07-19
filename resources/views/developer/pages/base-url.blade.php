@extends('developer.layouts.master') 
@section('content') 
<div class="developer-main-wrapper">
    <h1 class="heading-title mb-20">Base URL</h1>
    <p>The base URL for API requests is:</p>
    <div class="mb-10">
        <span>For PRODUCTION Mode: </span>
        <a href="{{ url('/')."/pay/api/v1" }}" class="highlight">{{ url('/')."/pay/api/v1" }}</a>
    </div>
    <div>
        <span>For SANDBOX Mode: </span>
        <a href="{{ url('/')."/pay/sandbox/api/v1" }}" class="highlight">{{ url('/')."/pay/sandbox/api/v1" }}</a>
    </div>
</div>
<div class="page-change-area"> 
    <div class="navigation-wrapper">
        <a href="{{ setRoute("developer.authentication") }}" class="left"><i class="las la-arrow-left me-1"></i> Authentication</a>
        <a href="{{ setRoute("developer.accessToken") }}" class="right">Access Token <i class="las la-arrow-right ms-1"></i></a>
    </div> 
</div>
@endsection