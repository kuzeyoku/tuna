@if (config('setting.information.cookie_notification_status') && isset($pages) && array_key_exists('cookie_policy_page', $pages))
    <div class="cookie" id="cookie-notification" style="display:none">
        <img src="{{ asset('assets/images/cookie.svg') }}" alt="cookie">
        <div class="title">
            {{ __('front/cookie.txt1') }}
        </div>
        <div class="description">
            {!! __('front/cookie.txt2', [
                'url' => route('page.show', [$pages['cookie_policy_page']->id, $pages['cookie_policy_page']->slug]),
            ]) !!}
        </div>
        <button class="cookie-btn" id="cookie-accept">{{ __('front/cookie.txt3') }}</button>
    </div>
    @section('script')
        <script>
            $(document).ready(function() {
                if ($.cookie("cookie_notification") === undefined) {
                    $("#cookie-notification").show("slow");
                }
            });

            $(document).on("click", "#cookie-accept", function() {
                $.cookie("cookie_notification", "accepted", {
                    expires: 1,
                    path: "/"
                });
                $("#cookie-notification").hide("slow");
            });
        </script>
    @endsection

@endif
