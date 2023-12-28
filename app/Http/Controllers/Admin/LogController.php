<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public static function logger($type, $message)
    {
        if ($type == "info") :
            self::info($message);
        elseif ($type == "error") :
            self::error($message);
        endif;
    }

    public static function info($message)
    {
        Log::channel('custom_info')->info(Auth::user()->name . " Tarafından " . $message);
    }

    public static function error($message)
    {
        Log::channel('custom_errors')->error($message);
    }
}
