@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.create"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['route' => "admin.{$route}.store", 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('Kapak Görseli') !!}<br>
        {!! Form::file('image', ['class' => 'dropify', 'accept' => '.png, .jpg, .jpeg, .gif']) !!}
    </div>
    <div class="form-group">
        {{ Form::label(__("admin/{$folder}.form_type")) }} <span class="manitory">*</span>
        {{ Form::select('type', [1 => __("admin/{$folder}.form_type_image"), 2 => __("admin/{$folder}.form_type_video")], 'default', ['class' => 'form-control']) }}
    </div>
    <div class="tab-content">
        @foreach (LanguageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
                    {!! Form::text("title[$lang->code]", null, ['placeholder' => __("admin/{$folder}.form_title_placeholder")]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", null, ['class' => 'editor']) !!}
                </div>
            </div>
        @endforeach
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
