@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.reply"))
@section('content')
    {!! Form::open(['url' => route("admin.{$route}.sendReply"), 'method' => 'post']) !!}
    {!! Form::hidden('message_id', $message->id) !!}
    <div class="form-group">
        {!! Form::label('email', __("admin/{$folder}.form_customer")) !!}
        {!! Form::text('email', $message->email, ['readonly' => '']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('subject', __("admin/{$folder}.form_subject")) !!}
        {!! Form::text('subject', 're:' . $message->subject) !!}
    </div>
    <div class="form-group">
        {!! Form::label('message', __("admin/{$folder}.form_content")) !!}
        {!! Form::textarea('message') !!}
    </div>
    <div class="form-group">
        {!! Form::submit(__("admin/{$folder}.form_send"), ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection
