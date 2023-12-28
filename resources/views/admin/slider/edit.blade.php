@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['url' => route("admin.{$route}.update", $slider), 'method' => 'put', 'files' => true]) !!}
    {!! Form::file('image', [
        'class' => 'dropify',
        'data-default-file' => $slider->getImageUrl(),
        'accept' => '.png, .jpg, .jpeg, .gif',
    ]) !!}
    <div class="tab-content">
        @foreach (languageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!}
                    {!! Form::text("title[$lang->code]", $slider->title[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_title_description"),
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", $slider->description[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_description_placeholder"),
                    ]) !!}
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('button', __("admin/{$folder}.form_button")) !!}
                {!! Form::text('button', $slider->button, [
                    'placeholder' => __("admin/{$folder}.form_button_placeholder"),
                ]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('video', __("admin/{$folder}.form_video")) !!}
                {!! Form::text('video', $slider->video, [
                    'placeholder' => __("admin/{$folder}.form_video_placeholder"),
                ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', $slider->order, [
                    'placeholder' => __('admin/general.order_placeholder'),
                ]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $slider->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
