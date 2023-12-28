<span class="badge p-2 bg-{{ App\Enums\StatusEnum::getStatus($item->status)->color() }}">
    <i class="bx bx-{{ App\Enums\StatusEnum::getStatus($item->status)->icon() }}"></i>
    {{ App\Enums\StatusEnum::getStatus($item->status)->title() }}
</span>
@if ($item->is_default)
    <span class="badge p-2 bg-secondary">
        <i class="bx bx-check-double"></i>
        {{ __('admin/general.default') }}
    </span>
@endif
