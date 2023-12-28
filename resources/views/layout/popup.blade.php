@if($popup)
<div id="modal">
    @if($popup->type == "image")
    <a href="{{ $popup->url }}"><img class="w-100 img-fluid" src="{{ $popup->getImageUrl() }}" alt="{{ $popup->getTitle() }}"></a>
    @elseif($popup->type == "text")
    {!! $popup->getDescription() !!}
    @endif
</div>
@section("script")
<script src="{{ asset('assets/js/izimodal.min.js') }}"></script>
@if($popup->type == "video")
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#modal").iziModal({
            title: '{{ $popup->getTitle() }}',
            background: '{{ $popup->color }}',
            closeOnEscape: "{{ $popup->closeOnEscape }}" == 1 ? true : false,
            closeButton: "{{ $popup->closeButton }}" == 1 ? true : false,
            overlay: true,
            overlayClose: "{{ $popup->overlayClose }}" == 1 ? true : false,
            timeout: parseInt("{{ $popup->time }}" * 1000),
            timeoutProgressbar: (parseInt("{{ $popup->time }}") > 0) ? true : false,
            pauseOnHover: "{{ $popup->pauseOnHover }}" == 1 ? true : false,
            iframe: true,
            autoOpen: true,
            iframeURL: '{{ $popup->video }}',
            width: parseInt('{{ $popup->width }}'),
            borderBottom: false,
        });
    });
</script>
@else
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#modal").iziModal({
            title: '{{ $popup->getTitle() }}',
            background: '{{ $popup->color }}',
            closeOnEscape: "{{ $popup->closeOnEscape }}" == 1 ? true : false,
            closeButton: "{{ $popup->closeButton }}" == 1 ? true : false,
            fullscreen: "{{ $popup->fullScreenButton }}" == 1 ? true : false,
            overlay: true,
            overlayClose: "{{ $popup->overlayClose }}" == 1 ? true : false,
            timeout: parseInt("{{ $popup->time }}" * 1000),
            timeoutProgressbar: (parseInt("{{ $popup->time }}") > 0) ? true : false,
            pauseOnHover: "{{ $popup->pauseOnHover }}" == 1 ? true : false,
            autoOpen: true,
            width: parseInt('{{ $popup->width }}'),
            borderBottom: false,
        });
    });
</script>
@endif
@endsection
@endif
