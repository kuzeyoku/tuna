<div class="form-group">
    {!! Form::label(__('admin/setting.general_title')) !!}
    {!! Form::text('title', config('setting.general.title'), [
        'placeholder' => __('admin/setting.general_title_placeholder'),
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label(__('admin/setting.general_description')) !!}
    {!! Form::textarea('description', config('setting.general.description'), [
        'placeholder' => __('admin/setting.general_description_placeholder'),
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label(__('admin/setting.general_keywords')) !!}
    {!! Form::text('keywords', config('setting.general.keywords'), [
        'placeholder' => __('admin/setting.general_keywords_placeholder'),
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label(__('admin/setting.general_slider_type')) !!}
    {!! Form::select(
        'slider_type',
        [
            'image' => 'Resim Slider',
            'video' => 'Video Slider',
        ],
        config('setting.general_slider_type'),
    ) !!}
</div>
