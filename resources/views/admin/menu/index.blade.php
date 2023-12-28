@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.title"));
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    {{ $menu ? __("admin/{$folder}.edit") : __("admin/{$folder}.create") }}
                </div>
                <div class="card-body">
                    @include('admin.layout.langTabs')
                    @if (!empty($menu))
                        @include("admin.{$folder}.edit_form")
                    @else
                        @include("admin.{$folder}.create_form")
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    {{ __("admin/{$folder}.content") }}
                </div>
                <div class="card-body">
                    <div class="menu">
                        <ul>
                            @forelse ($menus as $menu)
                                @if ($menu->parent_id == 0)
                                    <li class="parent d-flex flex-row justify-content-between align-center">
                                        <div>
                                            <a class="text-white">{{ $menu->getTitle() }}</a>
                                        </div>
                                        <div>
                                            <a href="{{ route("admin.{$folder}.edit", $menu) }}"
                                                class="btn btn-sm btn-light">
                                                {{ __('admin/general.edit') }}
                                            </a>
                                            {!! Form::open([
                                                'url' => route("admin.{$route}.destroy", $menu),
                                                'method' => 'delete',
                                                'class' => 'd-inline',
                                            ]) !!}
                                            <button type="button" class="btn btn-sm destroy-btn btn-danger">
                                                {{ __('admin/general.delete') }}
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </li>
                                    @if ($menu->subMenu)
                                        @include("admin.{$folder}.subMenus")
                                    @endif
                                @endif
                            @empty
                                <div class="alert alert-info">{{ __("admin/general.empty_table") }}</div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
