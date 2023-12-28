@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.images") . ' - ' . $project->title[app()->getLocale()])
@section('button')
    {!! Form::open([
        'url' => route("admin.{$route}.imageAllDelete", $project),
        'method' => 'delete',
        'class' => 'd-inline',
    ]) !!}
    <button type="button"
        class="btn btn-delete btn-sm position-absolute top-0 end-0 m-2 destroy-btn">{{ __('admin/general.all_delete') }}</button>
    {!! Form::close() !!}
@endsection
@section('content')
    {!! Form::open([
        'url' => route("admin.{$folder}.imageStore"),
        'class' => 'dropzone mb-3',
        'file' => true,
    ]) !!}
    {!! Form::hidden('project_id', $project->id) !!}
    {!! Form::close() !!}
    <div class="row">
        @foreach ($project->images as $image)
            <div class="col-md-2">
                <div class="p-2 border rounded position-relative mb-4">
                    <img src="{{ uploadFolder($folder, $image->image) }}" class="img-fluid">
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
