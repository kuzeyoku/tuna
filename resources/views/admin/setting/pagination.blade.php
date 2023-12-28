<div class="form-group">
    {!! Form::label(__('admin/setting.pagination_admin')) !!}
    {{ formInfo(__('admin/setting.pagination_admin_info')) }}
    {!! Form::number('admin', config('setting.pagination.admin'), [
        'placeholder' => __('admin/setting.pagination_admin_placeholder'),
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label(__('admin/setting.pagination_front')) !!}
    {{ formInfo(__('admin/setting.pagination_front_info')) }}
    {!! Form::number('front', config('setting.pagination.front'), [
        'placeholder' => __('admin/setting.pagination_front_placeholder'),
    ]) !!}
</div>
