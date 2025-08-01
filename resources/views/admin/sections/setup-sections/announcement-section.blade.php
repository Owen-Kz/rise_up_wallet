@php
    $default_lang_code = language_const()::NOT_REMOVABLE;
    $system_default_lang = get_default_language_code();
    $languages_for_js_use = $languages->toJson();
@endphp

@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/fontawesome-iconpicker.min.css') }}">
    <style>
        .fileholder {
            min-height: 374px !important;
        }

        .fileholder-files-view-wrp.accept-single-file .fileholder-single-file-view,.fileholder-files-view-wrp.fileholder-perview-single .fileholder-single-file-view{
            height: 330px !important;
        }
    </style>
@endpush

@section('page-title')
    @include('admin.components.page-title',['title' => __($page_title)])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("admin.dashboard"),
        ]
    ], 'active' => __("Setup Section")])
@endsection

@section('content')
    <div class="custom-card">
        <div class="card-header">
            <h6 class="title">{{ __($page_title) }}</h6>
        </div>
        <div class="card-body">
            <form class="card-form" action="{{ setRoute('admin.setup.sections.section.update',$slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center mb-10-none">
                    <div class="col-xl-12 col-lg-12">
                        <div class="product-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach ($languages as $item)
                                        <button class="nav-link @if (get_default_language_code() == $item->code) active @endif" id="{{$item->name}}-tab" data-bs-toggle="tab" data-bs-target="#{{$item->name}}" type="button" role="tab" aria-controls="{{ $item->name }}" aria-selected="true">{{ $item->name }}</button>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                @foreach ($languages as $item)
                                    @php
                                        $lang_code = $item->code;
                                    @endphp
                                    <div class="tab-pane @if (get_default_language_code() == $item->code) fade show active @endif" id="{{ $item->name }}" role="tabpanel" aria-labelledby="english-tab">
                                        <div class="form-group">
                                            @include('admin.components.form.input',[
                                                'label'     => "Heading*",
                                                'name'      => $item->code . "_heading",
                                                'value'     => old($item->code . "_heading",$data->value->language->$lang_code->heading ?? "")
                                            ])
                                        </div>
                                        {{-- <div class="form-group">
                                            @include('admin.components.form.input',[
                                                'label'     => "Sub Heading*",
                                                'name'      => $item->code . "_sub_heading",
                                                'value'     => old($item->code . "_sub_heading",$data->value->language->$lang_code->sub_heading ?? "")
                                            ])
                                        </div> --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 form-group">
                        @include('admin.components.button.form-btn',[
                            'class'         => "w-100 btn-loading",
                            'text'          => "Submit",
                            'permission'    => "admin.setup.sections.section.update"
                        ])
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="custom-card mt-5">
        <div class="card-header">
            <h6 class="title">{{ __("Web Journal Dashboard") }}</h6>
            <div class="button-link">
                @include('admin.components.link.custom',[
                    'text'          => 'Categories',
                    'class'         => 'btn btn--primary',
                    'href'          => setRoute('admin.setup.sections.announcement.category.index'),
                    'permission'    => 'admin.setup.sections.announcement.category.index',
                ])
                @include('admin.components.link.custom',[
                    'text'          => 'Web Journals',
                    'class'         => 'btn btn--base',
                    'href'          => setRoute('admin.setup.sections.announcement.index'),
                    'permission'    => 'admin.setup.sections.announcement.index',
                ])
            </div>
        </div>

        <div class="card-body">
            <div class="dashboard-area">
                <div class="dashboard-item-area">
                    <div class="row">
                        <div class="col-xxxl-4 col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">
                            <div class="dashbord-item border">
                                <div class="dashboard-content">
                                    <div class="left">
                                        <h6 class="title">{{ __("Total Category") }}</h6>
                                        <div class="user-info">
                                            <h2 class="user-count">{{ $total_categories }}</h2>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="chart" id="chart6" data-percent="{{ get_percentage_from_two_number($total_categories,$total_categories) }}"><span>{{ get_percentage_from_two_number($total_categories,$total_categories) }}%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxxl-4 col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">
                            <div class="dashbord-item border">
                                <div class="dashboard-content">
                                    <div class="left">
                                        <h6 class="title">{{ __("Active Category") }}</h6>
                                        <div class="user-info">
                                            <h2 class="user-count">{{ $active_categories }}</h2>
                                        </div>
                                        {{-- <div class="user-badge">
                                            <span class="badge badge--info">Total 40k</span>
                                            <span class="badge badge--warning">Pending 20K</span>
                                        </div> --}}
                                    </div>
                                    <div class="right">
                                        <div class="chart" id="chart7" data-percent="{{ get_percentage_from_two_number($total_categories,$active_categories) }}"><span>{{ get_percentage_from_two_number($total_categories,$active_categories) }}%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxxl-4 col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">
                            <div class="dashbord-item border">
                                <div class="dashboard-content">
                                    <div class="left">
                                        <h6 class="title">{{ __("Total Web Journal") }}</h6>
                                        <div class="user-info">
                                            <h2 class="user-count">{{ $total_announcements }}</h2>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="chart" id="chart8" data-percent="{{ get_percentage_from_two_number($total_announcements,$total_announcements) }}"><span>{{ get_percentage_from_two_number($total_announcements,$total_announcements) }}%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxxl-4 col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">
                            <div class="dashbord-item border">
                                <div class="dashboard-content">
                                    <div class="left">
                                        <h6 class="title">{{ __("Active Web Journal") }}</h6>
                                        <div class="user-info">
                                            <h2 class="user-count">{{ $active_announcements }}</h2>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="chart" id="chart9" data-percent="{{ get_percentage_from_two_number($total_announcements,$active_announcements) }}"><span>{{ get_percentage_from_two_number($total_announcements,$active_announcements) }}%</span></div>
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

@push('script')
    <script src="{{ asset('backend/js/fontawesome-iconpicker.js') }}"></script>
    <script>
        // icon picker
        $('.icp-auto').iconpicker();
    </script>
    <script>
        openModalWhenError("testimonial-add","#testimonial-add");

        var default_language = "{{ $default_lang_code }}";
        var system_default_language = "{{ $system_default_lang }}";
        var languages = "{{ $languages_for_js_use }}";
        languages = JSON.parse(languages.replace(/&quot;/g,'"'));

        $(".delete-modal-button").click(function(){
            var oldData = JSON.parse($(this).parents("tr").attr("data-item"));

            var actionRoute =  "{{ setRoute('admin.setup.sections.section.item.delete',$slug) }}";
            var target = oldData.id;
            var message     = `Are you sure to <strong>delete</strong> item?`;

            openDeleteModal(actionRoute,target,message);
        }); 
    </script>
@endpush