@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/izimodal.min.css') }}">
@endsection
@section('content')
    @include('admin.layout.langTabs')
    <p>{{ __("admin/{$folder}.info") }}</p>
    {!! Form::open(['url' => route("admin.{$route}.update", $popup), 'method' => 'put', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('type', __("admin/{$folder}.form_type")) !!}
        {!! Form::select(
            'type',
            [
                0 => __('admin/general.select'),
                'image' => __("admin/{$folder}.type_image"),
                'text' => __("admin/{$folder}.type_text"),
                'video' => __("admin/{$folder}.type_video"),
            ],
            $popup->type,
            ['id' => 'type'],
        ) !!}
    </div>
    <div class="form-group" id="image" style="display: none">
        {!! Form::file('image', [
            'class' => 'dropify',
            'data-default-file' => $popup->image_url,
            'accept' => '.png, .jpg, .jpeg, .gif',
        ]) !!}
    </div>
    <div class="tab-content">
        @foreach (languageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!}
                    {!! Form::text("title[$lang->code]", $popup->titles[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_title_placeholder"),
                    ]) !!}
                </div>
                <div class="form-group" id="text" style="display: none">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", $popup->descriptions[$lang->code] ?? null, ['class' => 'editor']) !!}
                </div>
            </div>
        @endforeach
    </div>
    <div class="form-group" id="video" style="display: none">
        {!! Form::label('video', __("admin/{$folder}.form_video")) !!}
        {!! Form::url('video', $popup->video, [
            'placeholder' => __("admin/{$folder}.form_video_placeholder"),
            'id' => null,
        ]) !!}
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('time', __("admin/{$folder}.form_time")) !!}
                {!! Form::number('time', $popup->settings->time, [
                    'placeholder' => __("admin/{$folder}.form_time_placeholder"),
                ]) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('width', __("admin/{$folder}.form_width")) !!}
                {!! Form::number('width', $popup->settings->width, [
                    'placeholder' => __("admin/{$folder}.form_width_placeholder"),
                ]) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('url', __("admin/{$folder}.form_url")) !!}
                {!! Form::url('url', $popup->url, ['placeholder' => __("admin/{$folder}.form_url_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('closeButton', __("admin/{$folder}.form_closeButton")) !!}
                {!! Form::select('closeButton', App\Enums\StatusEnum::getTrueFalseSelectArray(), $popup->settings->closeButton) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('closeOnEscape', __("admin/{$folder}.form_closeOnEscape")) !!}
                {!! Form::select(
                    'closeOnEscape',
                    App\Enums\StatusEnum::getTrueFalseSelectArray(),
                    $popup->settings->closeOnEscape,
                ) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('overlayClose', __("admin/{$folder}.form_overlayClose")) !!}
                {!! Form::select(
                    'overlayClose',
                    App\Enums\StatusEnum::getTrueFalseSelectArray(),
                    $popup->settings->overlayClose,
                ) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('pauseOnHover', __("admin/{$folder}.form_pauseOnHover")) !!}
                {!! Form::select(
                    'pauseOnHover',
                    App\Enums\StatusEnum::getTrueFalseSelectArray(),
                    $popup->settings->pauseOnHover,
                ) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('fullScreenButton', __("admin/{$folder}.form_fullScreenButton")) !!}
                {!! Form::select(
                    'fullScreenButton',
                    App\Enums\StatusEnum::getTrueFalseSelectArray(),
                    $popup->settings->fullScreenButton,
                ) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('color', __("admin/{$folder}.form_color")) !!}
                {!! Form::color('color', $popup->settings->color, [
                    'class' => 'form-control form-control-color',
                    'placeholder' => __("admin/{$folder}.form_color_placeholder"),
                ]) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
        {!! Form::select('status', statusList(), $popup->status) !!}
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::submit(__('admin/general.saveAndContinue'), [
        'name' => 'saveAndContinue',
        'class' => 'btn btn-success',
    ]) !!}
    {!! Form::close() !!}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var type = $("#type").val()
            $("#" + type).show();
        });
        $("#type").on("change", function() {
            var type = $(this).val();
            $("#" + type).show();
            $("#text, #image, #video").not("#" + type).hide();
        });
    </script>
@endsection
