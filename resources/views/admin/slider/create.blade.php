@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.create"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['route' => "admin.{$route}.store", 'method' => 'post', 'files' => true]) !!}
    {!! Form::file('image', ['class' => 'dropify', "accept" => ".png, .jpg, .jpeg, .gif"]) !!}
    <div class="tab-content">
        @foreach (languageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!}
                    {!! Form::text("title[$lang->code]", null, ['placeholder' => __("admin/{$folder}.form_title_placeholder")]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", null, [
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
                {!! Form::text('button', null, ['placeholder' => __("admin/{$folder}.form_button_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('video', __("admin/{$folder}.form_video")) !!}
                {!! Form::text('video', null, ['placeholder' => __("admin/{$folder}.form_video_placeholder")]) !!}
            </div>
        </div>
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
                {!! Form::label('status', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), 'default') !!}
            </div>
        </div>
    </div>

    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
