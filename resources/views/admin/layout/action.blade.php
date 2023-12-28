<a href="{{ route("admin.{$route}.edit", $item) }}" class="btn btn-edit">@svg('fas-pen-to-square')</a>
{!! Form::open([
    'url' => route("admin.{$route}.destroy", $item),
    'method' => 'delete',
    'class' => 'd-inline',
]) !!}
<button type="button" class="btn btn-delete destroy-btn">@svg('fas-times')</button>
{!! Form::close() !!}
