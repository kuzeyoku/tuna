@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.create"))
@section('content')
    {!! Form::open(['route' => "admin.{$route}.store", 'method' => 'post', 'files' => true]) !!}
    {{-- {!! Form::file('image', ['class' => 'dropify']) !!} --}}
    <div class="form-group">
        {!! Form::label('name', __("admin/{$folder}.form_name")) !!}
        {!! Form::text('name', null, ['placeholder' => __("admin/{$folder}.form_name_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('company', __("admin/{$folder}.form_company")) !!}
        {!! Form::text('company', null, ['placeholder' => __("admin/{$folder}.form_company_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('position', __("admin/{$folder}.form_position")) !!}
        {!! Form::text('position', null, ['placeholder' => __("admin/{$folder}.form_position_placeholder")]) !!}
    </div>
    <div class="form-group">
        {!! Form::label('message', __("admin/{$folder}.form_message")) !!}
        {!! Form::textarea('message', null, ['placeholder' => __("admin/{$folder}.form_message_placeholder")]) !!}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', 0, ['placeholder' => __('admin/general.order_placeholder')]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), 'default') !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
