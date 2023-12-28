@extends('admin.layout.main')
@section('pageTitle', __("admin/{$folder}.list"))
@section('content')
    <div class="table-responsive">
        <table class="table table-nowrap table-bordered table-center mb-0">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>{{ __("admin/{$folder}.table_name") }}</th>
                    <th>{{ __("admin/{$folder}.table_subject") }}</th>
                    <th>{{ __('admin/general.table_created_at') }}</th>
                    <th>{{ __('admin/general.table_updated_at') }}</th>
                    <th>{{ __('admin/general.table_status') }}</th>
                    <th>{{ __('admin/general.table_action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>{{ $item->updated_at->diffForHumans() }}</td>
                        <td>{{ statusView($item->status) }}</td>
                        <td>
                            <a class="btn btn-show" href="{{ route("admin.{$route}.show", $item) }}">@svg('fas-eye')</a>
                            {!! Form::open([
                                'url' => route("admin.{$route}.destroy", $item),
                                'method' => 'delete',
                                'class' => 'd-inline',
                            ]) !!}
                            <button type="button" class="btn btn-delete destroy-btn">@svg('fas-times')</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('admin/general.table_no_data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
