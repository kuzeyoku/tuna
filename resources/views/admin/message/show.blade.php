@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.show"))
@section('content')
<img class="avatar-sm" src="{{ asset('assets/admin/img/avatar.png') }}">
<div>{{ $message->name }}</div>
<small class="text-muted">
    {{ __("admin/{$folder}.email") }} {{ $message->email }} |
    {{ __("admin/{$folder}.phone") }} {{ $message->phone }} |
    {{ __("admin/{$folder}.ip") }} {{ $message->ip }}
</small>
<hr>
<h4 class="mb-3">{{ $message->subject }}</h4>
{!! $message->message !!}
<hr>
<a class="btn btn-primary" href="{{ route("admin.{$route}.reply", $message) }}">
    @svg('fas-reply') {{ __("admin/{$folder}.reply") }}
</a>
{!! Form::open(['url' => route("admin.{$route}.destroy", $message),'method' => 'delete', 'class' => 'd-inline']) !!}
<button type="button" class="btn btn-delete destroy-btn">@svg('fas-times') {{ __('admin/general.delete') }}</button>
{!! Form::close() !!}
@endsection
