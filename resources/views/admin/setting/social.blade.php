@php
    $formElementList = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin'];
@endphp
@foreach ($formElementList as $element)
    <div class="form-group">
        {!! Form::label(__('admin/setting.social_' . $element)) !!}
        {!! Form::text("{$element}", config('setting.social.' . $element), [
            'placeholder' => __("admin/{$folder}.social_{$element}_placeholder"),
        ]) !!}
    </div>
@endforeach
