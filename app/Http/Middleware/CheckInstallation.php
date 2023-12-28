<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


use function PHPUnit\Framework\fileExists;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (file_exists(config_path("custom_config.php")) && config("custom_config.setup") === true) {
            return $next($request);
        }
        return redirect()->route('setup.index')->with("info", "Kurulum henüz tamamlanmadı.");
    }
}
