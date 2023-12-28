@php
    $formElementList = ['host', 'port', 'username', 'password', 'encryption', 'from_address', 'from_name', 'reply_address'];
@endphp

@foreach ($formElementList as $element)
    <div class="form-group">
        {!! Form::label(__('admin/setting.smtp_' . $element)) !!}
        {!! Form::text("{$element}", config('setting.smtp.' . $element), [
            'placeholder' => __("admin/{$folder}.smtp_{$element}_placeholder"),
        ]) !!}
    </div>
@endforeach
