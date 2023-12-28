<div class="form-group">
    {!! Form::label('cookie_notification_status', __('admin/setting.information_cookie_notification_status')) !!}
    {!! Form::select(
        'cookie_notification_status',
        App\Enums\StatusEnum::getOnOffSelectArray(),
        config('setting.information.cookie_notification_status'),
    ) !!}
</div>
@php
    $formElementList = ['cookie_policy_page', 'user_agreement_page', 'privacy_agreement_page', 'kvkk_page', 'about_page', 'faq_page'];
@endphp
@foreach ($formElementList as $element)
    <div class="form-group">
        {!! Form::label($element, __('admin/setting.information_' . $element)) !!}
        {!! Form::select($element, $pagelist, config('setting.information.' . $element), [
            'placeholder' => __('admin/general.select'),
        ]) !!}
    </div>
@endforeach
