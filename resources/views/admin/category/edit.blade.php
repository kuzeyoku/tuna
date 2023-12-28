@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['url' => route("admin.{$route}.update", $category), 'method' => 'put']) !!}
    <div class="tab-content">
        @foreach (LanguageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
                    {!! Form::text("title[$lang->code]", $category->title[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_title_placeholder"),
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", $category->description[$lang->code] ?? null, [
                        'class' => 'editor',
                    ]) !!}
                </div>
            </div>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('module', __("admin/{$folder}.form_module")) !!} <span class="manitory">*</span>
        {!! Form::select('module', $modules, $category->module) !!}
    </div>
    <div class="form-group">
        {!! Form::label('parent', __("admin/{$folder}.form_parent")) !!}
        {!! Form::select('parent', $categories, $category->parent_id) !!}
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', $category->order, ['placeholder' => __('admin/general.order_placeholder')]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $category->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
