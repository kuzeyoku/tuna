@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.create"))
@section('content')
    @include('admin.layout.langTabs')
    <p>{{ __("admin/{$folder}.info") }}</p>
    {!! Form::open(['route' => "admin.{$route}.store", 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('type', __("admin/{$folder}.form_type")) !!}
        {!! Form::select(
            'type',
            [
                'image' => __("admin/{$folder}.type_image"),
                'text' => __("admin/{$folder}.type_text"),
                'video' => __("admin/{$folder}.type_video"),
            ],
            'default',
            ['id' => 'type'],
        ) !!}
    </div>
    <div class="form-group" id="image">
        {!! Form::file('image', ['class' => 'dropify']) !!}
    </div>
    @foreach (languageList() as $key => $lang)
        <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
            <div class="form-group">
                {!! Form::label('title', __("admin/{$folder}.form_title")) !!}
                {!! Form::text("title[$lang->code]", null, ['placeholder' => __("admin/{$folder}.form_title_placeholder")]) !!}
            </div>
            <div class="form-group" id="text">
                {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                {!! Form::textarea("description[$lang->code]", null, ['class' => 'editor']) !!}
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('time', __("admin/{$folder}.form_time")) !!}
                {!! Form::number('time', null, ['placeholder' => __("admin/{$folder}.form_time_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('width', __("admin/{$folder}.form_width")) !!}
                {!! Form::number('width', null, ['placeholder' => __("admin/{$folder}.form_width_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('url', __("admin/{$folder}.form_url")) !!}
                {!! Form::url('url', null, ['placeholder' => __("admin/{$folder}.form_url_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group" id="video">
                {!! Form::label('video', __("admin/{$folder}.form_video")) !!}
                {!! Form::url('video', null, ['placeholder' => __("admin/{$folder}.form_video_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('closeButton', __("admin/{$folder}.form_closeButton")) !!}
                {!! Form::select('closeButton', App\Enums\StatusEnum::getTrueFalseSelectArray()) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('closeOnEscape', __("admin/{$folder}.form_closeOnEscape")) !!}
                {!! Form::select('closeOnEscape', App\Enums\StatusEnum::getTrueFalseSelectArray()) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('overlayClose', __("admin/{$folder}.form_overlayClose")) !!}
                {!! Form::select('overlayClose', App\Enums\StatusEnum::getTrueFalseSelectArray()) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('pauseOnHover', __("admin/{$folder}.form_pauseOnHover")) !!}
                {!! Form::select('pauseOnHover', App\Enums\StatusEnum::getTrueFalseSelectArray()) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('fullScreenButton', __("admin/{$folder}.form_fullScreenButton")) !!}
                {!! Form::select('fullScreenButton', App\Enums\StatusEnum::getTrueFalseSelectArray()) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('color', __("admin/{$folder}.form_color")) !!}
                {!! Form::text('color', null, ['placeholder' => __("admin/{$folder}.form_color_placeholder")]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
        {!! Form::select('status', statusList(), 'default') !!}
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
@section('script')
    <script>
        $("#type").on("change", function() {
            if ($(this).val() == "image") {
                $("#image").show();
                $("#text").hide();
            } else if ($(this).val() == "text") {
                $("#image").hide();
                $("#text").show();
            } else {
                $("#image").hide();
                $("#text").hide();
            }
        });
    </script>
@endsection
