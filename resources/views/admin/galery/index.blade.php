@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.title"))
@section('content')
    <div class="table-responsive">
        <table class="table table-nowrap table-bordered table-center mb-0">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>{{ __("admin/{$folder}.table_title") }}</th>
                    <th>{{ __("admin/{$folder}.table_type") }}</th>
                    <th>{{ __('admin/general.table_created_at') }}</th>
                    <th>{{ __('admin/general.table_updated_at') }}</th>
                    <th>{{ __('admin/general.table_action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>{{ $item->updated_at->diffForHumans() }}</td>
                        <td>
                            @if ($item->type == 1)
                                <a href="{{ route("admin.{$route}.image", $item) }}"
                                    class="btn btn-image">@svg('fas-image')</a>
                            @elseif($item->type == 2)
                                <a href="{{ route("admin.{$route}.video", $item) }}"
                                    class="btn btn-image">@svg('fas-video')</a>
                            @endif
                            @include('admin.layout.action')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('admin/general.table_no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
