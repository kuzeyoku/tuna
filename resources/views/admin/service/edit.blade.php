@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['url' => route("admin.{$route}.update", $service), 'method' => 'put', 'files' => true]) !!}
    {!! Form::file('image', [
        'class' => 'dropify',
        'data-default-file' => $service->getImageUrl(),
    ]) !!}
    <div class="tab-content">
        @foreach (languageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
                    {!! Form::text("title[$lang->code]", $service->title[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_title_placeholder"),
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", $service->description[$lang->code] ?? null, [
                        'class' => 'editor',
                    ]) !!}
                </div>
            </div>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('category', __("admin/{$folder}.form_category")) !!}
        {!! Form::select('category_id', $categories, $service->category_id) !!}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="mamitory">*</span>
                {!! Form::number('order', $service->order, ['placeholder' => __('admin/general.order_placeholder')]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $service->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
