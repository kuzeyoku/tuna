@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.images") . ' - ' . $galery->titles[config('app.fallback_locale')])
@section('button')
    {!! Form::open([
        'url' => route("admin.{$route}.videoAllDelete", $galery),
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
        'url' => route("admin.{$folder}.videoStore", $galery),
    ]) !!}
    <div class="form-group">
        {!! Form::label(__("admin/{$folder}.form_video")) !!}
        {!! Form::url('video', null, ['placeholder' => __("admin/{$folder}.form_video_placeholder")]) !!}
    </div>
    {!! Form::submit('Ekle', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    <hr>
    <div class="row mt-3">
        @foreach ($galery->videos as $video)
            <div class="col-md-3 mr-2">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $video->video }}" allowfullscreen></iframe>
                </div>
                {!! Form::open([
                    'url' => route("admin.{$route}.videoDelete", $video),
                    'method' => 'delete',
                    'class' => 'd-inline',
                ]) !!}
                <button type="button" class="btn btn-danger btn-sm m-2 destroy-btn">{{ __('admin/general.delete') }}</button>
                {!! Form::close() !!}
            </div>
        @endforeach
    </div>
@endsection
