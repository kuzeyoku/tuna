@extends('admin.layout.main')
@section('pageTitle', 'Yönetim Paneli')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{ Auth::user()->name }}</h4>
                    <h5>Hoşgeldiniz - IP: {{ request()->ip() }}</h5>
                </div>
                <div class="dash-imgs">
                    @svg('fas-user')
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    @if ($messages > 0)
                        <h4>{{ $messages }}</h4>
                        <h5>Okunmamış Mesajınız Var - <a class="text-white"
                                href="{{ route('admin.message.index') }}">Mesajlara Git</a></h5>
                    @else
                        <h5>Okunmamış Mesajınız Yok</h5>
                    @endif
                </div>
                <div class="dash-imgs">
                    @svg('fas-envelope')
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>100</h4>
                    <h5>Bugün Toplam Ziyaretçi</h5>
                </div>
                <div class="dash-imgs">
                    @svg('fas-user')
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>105</h4>
                    <h5>Toplam Ziyaretçi</h5>
                </div>
                <div class="dash-imgs">
                    @svg('fas-users')
                </div>
            </div>
        </div>
    </div>

@endsection
@section('card')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between">
                    <h3 class="card-title">İşlem Kayıtları</h3>
                    {!! Form::open(['url' => route('admin.logclean')], ['method' => 'post']) !!}
                    {!! Form::hidden('file', 'info') !!}
                    <button type="button" class="btn btn-danger btn-sm logclean">Temizle</button>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <ul class="overflow-auto info-log-list">
                        @forelse (array_reverse($infoLogs) as $log)
                            <li>{{ $log }}</li>
                        @empty
                            <li>Log Kaydı Bulunamadı</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between">
                    <h3 class="card-title">Hata Kayıtları</h3>
                    {!! Form::open(['url' => route('admin.logclean')], ['method' => 'post']) !!}
                    {!! Form::hidden('file', 'errors') !!}
                    <button type="button" class="btn btn-danger btn-sm logclean">Temizle</button>
                    {!! Form::close() !!}
                </div>
                <div class="card-body">
                    <ul class="overflow-auto error-log-list">
                        @forelse (array_reverse($errorLogs) as $log)
                            <li>{{ $log }}</li>
                        @empty
                            <li>Log Kaydı Bulunamadı</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endSection
