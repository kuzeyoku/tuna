@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['url' => route("admin.{$route}.update", $project), 'method' => 'put', 'files' => true]) !!}
    <div class="d-flex align-content-center flex-wrap">
        <div class="form-group">
            {!! Form::label('image', __("admin/{$folder}.form_image")) !!}
            {!! Form::file('image', ['class' => 'dropify', 'data-default-file' => $project->getImageUrl()]) !!}
        </div>
    </div>
    <div class="tab-content">
        @foreach (languageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
                    {!! Form::text("title[$lang->code]", $project->title[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_title_placeholder"),
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", $project->description[$lang->code] ?? null, [
                        'class' => 'editor',
                    ]) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('features', __("admin/{$folder}.form_features")) }}
                    {{ Form::textarea("features[$lang->code]", $project->features[$lang->code] ?? null, ['placeholder' => __("admin/{$folder}.form_features_placeholder")]) }}
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('start_date', __("admin/{$folder}.form_start_date")) !!}
                {!! Form::date('start_date', $project->start_date) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('end_date', __("admin/{$folder}.form_end_date")) !!}
                {!! Form::date('end_date', $project->end_date) !!}
            </div>
        </div>
    </div> --}}
    <div class="form-group">
        {!! Form::label('category', __("admin/{$folder}.form_category")) !!}
        {!! Form::select('category_id', $categories, $project->category_id) !!}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('video', __("admin/{$folder}.form_video")) !!}
                {!! Form::text('video', $project->video, ['placeholder' => __("admin/{$folder}.form_video_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('model3D', __("admin/{$folder}.form_model3D")) !!}
                {!! Form::text('model3D', $project->model3D, ['placeholder' => __("admin/{$folder}.form_model3D_placeholder")]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', $project->order, ['placeholder' => __('admin/general.order_placeholder')]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $project->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
