@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.edit"))
@section('content')
    @include('admin.layout.langTabs')
    {!! Form::open(['url' => route("admin.{$route}.update", $product), 'method' => 'put', 'files' => true]) !!}
    {!! Form::file('image', [
        'class' => 'dropify',
        'data-default-file' => uploadFolder($folder, $product->image),
        'accept' => '.jpg, .png, .gif'
    ]) !!}
    <div class="tab-content">
        @foreach (languageList() as $key => $lang)
            <div id="{{ $lang->code }}" class="tab-pane fade @if ($loop->first) active show @endif">
                <div class="form-group">
                    {!! Form::label('title', __("admin/{$folder}.form_title")) !!} <span class="manitory">*</span>
                    {!! Form::text("title[$lang->code]", $product->title[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_title_placeholder"),
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', __("admin/{$folder}.form_description")) !!}
                    {!! Form::textarea("description[$lang->code]", $product->description[$lang->code] ?? null, [
                        'class' => 'editor',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('features', __("admin/{$folder}.form_features")) !!}
                    {!! Form::textarea("features[$lang->code]", $product->features[$lang->code] ?? null, [
                        'placeholder' => __("admin/{$folder}.form_features_placeholder"),
                    ]) !!}
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{-- <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('price', __("admin/{$folder}.form_price")) !!}
                {!! Form::number('price', $product->price, ['placeholder' => __("admin/{$folder}.form_price_placeholder")]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('currency', __("admin/{$folder}.form_currency")) !!}
                {!! Form::text('currency', $product->currency, [
                    'placeholder' => __("admin/{$folder}.form_currency_placeholder"),
                ]) !!}
            </div>
        </div> --}}
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('category', __("admin/{$folder}.form_category")) !!}
                {!! Form::select('category_id', $categories, $product->category_id) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('video', __("admin/{$folder}.form_video")) !!}
                {!! Form::text('video', $product->video, ['placeholder' => __("admin/{$folder}.form_video_placeholder")]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('order', __('admin/general.order')) !!} <span class="manitory">*</span>
                {!! Form::number('order', $product->order, ['placeholder' => __('admin/general.order_placeholder')]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {!! Form::label('status_', __('admin/general.status')) !!} <span class="manitory">*</span>
                {!! Form::select('status', statusList(), $product->status) !!}
            </div>
        </div>
    </div>
    {!! Form::submit(__('admin/general.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
