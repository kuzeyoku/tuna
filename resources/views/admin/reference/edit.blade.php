@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    {!! Form::open(['url' => route("admin.{$route}.update", $reference), 'method' => 'put', 'files' => true]) !!}
    {!! Form::file('image', [
        'class' => 'dropify',
        'data-default-file' => uploadFolder($folder, $reference->image),
    ]) !!}
    <div class="form-group">
        {!! Form::label('url', __("admin/{$folder}.form_url")) !!}
        {!! Form::text('url', $reference->url, ['placeholder' => "admin/{$folder}.form_url_placeholder"]) !!}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', $reference->order, ['placeholder' => __('admin/general.order_placeholder')]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $reference->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
