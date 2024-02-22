@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.images") . ' - ' . $galery->titles[config('app.fallback_locale')])
@section('button')
    {!! Form::open([
        'url' => route("admin.{$route}.imageAllDelete", $galery),
        'method' => 'delete',
        'class' => 'd-inline',
        'accept' => '.png, .jpg, .jpeg, .gif',
    ]) !!}
    <button type="button"
        class="btn btn-delete btn-sm position-absolute top-0 end-0 m-2 destroy-btn">{{ __('admin/general.all_delete') }}</button>
    {!! Form::close() !!}
@endsection
@section('content')
    {!! Form::open([
        'url' => route("admin.{$folder}.imageStore", $galery),
        'class' => 'dropzone mb-3',
        'file' => true,
    ]) !!}
    {!! Form::close() !!}
    <div class="row">
        @foreach ($galery->images as $image)
            <div class="col-md-2">
                <div class="p-2 border rounded position-relative mb-4">
                    <img src="{{ $image->image_url }}" class="img-fluid">
                    {!! Form::open([
                        'url' => route("admin.{$route}.imageDelete", $image),
                        'method' => 'delete',
                        'class' => 'd-inline',
                    ]) !!}
                    <button type="button"
                        class="btn btn-delete btn-sm position-absolute top-0 end-0 m-2 destroy-btn">{{ __('admin/general.delete') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection