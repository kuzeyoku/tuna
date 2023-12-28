@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    {!! Form::open(['url' => route("admin.{$route}.update", $language), 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
        {!! Form::text('title', $language->title, ['placeholder' => __("admin/{$folder}.form_title_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('code', __("admin/{$folder}.form_code")) !!} <span class="manitory">*</span>
        {!! Form::text('code', $language->code, ['placeholder' => __("admin/{$folder}.form_code_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
        {!! Form::select('status', statusList(), $language->status) !!}
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
