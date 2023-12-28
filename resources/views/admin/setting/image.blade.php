<div class="row mb-3">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label(__('admin/setting.image_folder')) !!}
            {!! Form::text('folder', config('setting.image.folder'), [
                'placeholder' => __('admin/setting.image_folder_placeholder'),
            ]) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label(__('admin/setting.image_max_size')) !!}
            {!! Form::number('max_size', config('setting.image.max_size'), [
                'placeholder' => __('admin/setting.image_max_size_placeholder'),
            ]) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label(__('admin/setting.image_quality')) !!}
            {!! Form::number('quality', config('setting.image.quality'), [
                'placeholder' => __('admin/setting.image_quality_placeholder'),
            ]) !!}
        </div>
    </div>

</div>
