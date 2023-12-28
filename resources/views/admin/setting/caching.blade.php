<div class="form-group">
    {{ Form::label(__('admin/setting.caching_status')) }}
    {{ Form::select(
        'status',
        [
            0 => __('admin/general.off'),
            1 => __('admin/general.on'),
        ],
        config('setting.caching.status'),
    ) }}
</div>
<div class="form-group">
    {{ Form::label(__('admin/setting.caching_time')) }}
    {{ formInfo(__('admin/setting.caching_time_info')) }}
    {{ Form::text('time', config('setting.caching.time'), [
        'placeholder' => __('admin/setting.caching_time_placeholder'),
    ]) }}
</div>
