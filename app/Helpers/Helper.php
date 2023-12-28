<?php

use Illuminate\Support\Facades\Cache;

function statusView(string $status)
{
    $statusEnum = \App\Enums\StatusEnum::getStatus($status);
    echo $statusEnum->badge();
}

function languageList()
{
    return Cache::remember('languageList', 3600, function () {
        return \App\Services\Admin\LanguageService::toArray();
    });
}

function statusList()
{
    return Cache::remember('statusList', 3600, function () {
        return \App\Enums\StatusEnum::toSelectArray();
    });
}

function formInfo($text)
{
    echo '<span data-toggle="tooltip" data-placement="right" title="' . $text . '">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <g>
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-5h2v2h-2v-2zm2-1.645V14h-2v-1.5a1 1 0 0 1 1-1 1.5 1.5 0 1 0-1.471-1.794l-1.962-.393A3.501 3.501 0 1 1 13 13.355z"></path>
            </g>
        </svg>
    </span>';
}

function uploadFolder($folder, $file)
{
    return asset("storage/" . config("setting.image.upload_folder", "image") . "/" . $folder . "/" . $file);
}
