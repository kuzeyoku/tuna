@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    {!! Form::open(['url' => route("admin.{$route}.update", $brand), 'method' => 'put', 'files' => true]) !!}
    {!! Form::file('image', [
        'class' => 'dropify',
        'data-default-file' => $brand->getImageUrl(),
    ]) !!}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('title', __("admin/{$folder}.form_title")) !!}
                {!! Form::text('title', $brand->title, ['placeholder' => __("admin/{$folder}.form_title_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('url', __("admin/{$folder}.form_url")) !!}
                {!! Form::text('url', $brand->url, ['placeholder' => __("admin/{$folder}.form_url_placeholder")]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', $brand->order) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $brand->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
