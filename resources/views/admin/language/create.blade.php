@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.create"))
@section('content')
    {!! Form::open(['route' => "admin.{$route}.store", 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
        {!! Form::text('title', null, ['placeholder' => __("admin/{$folder}.form_title_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('code', __("admin/{$folder}.form_code")) !!} <span class="manitory">*</span>
        {!! Form::text('code', null, ['placeholder' => __("admin/{$folder}.form_code_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
        {!! Form::select('status', statusList(), 'default') !!}
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
