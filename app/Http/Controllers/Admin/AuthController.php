<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Requests\FormAuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $route;
    protected $folder;

    public function __construct()
    {
        $this->route = "auth";
        $this->folder = "auth";
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.index');
        }
        return view("admin.{$this->folder}.login");
    }

    public function authenticate(FormAuthRequest $request)
    {
        if (!$this->recaptcha($request)) {
            return back()
                ->withInput()
                ->withError(__("admin/{$this->folder}.recaptcha_error"));
        }

        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            LogController::logger("info", "Giriş Yapıldı.");
            $message = [
                "title" => __("admin/{$this->folder}.login_success_title", ["name" => Auth::user()->name]),
                "message" => __("admin/{$this->folder}.login_success_message")
            ];
            return redirect()
                ->intended('admin')
                ->withSuccess($message);
        }
        LogController::logger("error", "Başarısız Giriş Denemesi - IP: " . $request->ip() . " - Email: " . $request->email);
        return back()
            ->withInput()
            ->withError(__("admin/{$this->folder}.login_error"));
    }


    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()
            ->route("admin.{$this->route}.login")
            ->withSuccess(__("admin/{$this->folder}.logout_success"));
    }

    protected function recaptcha(FormAuthRequest $request)
    {
        if (config("setting.recaptcha.status") === StatusEnum::Active->value) {
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . config("setting.recaptcha.secret_key") . '&response=' . $request->{"g-recaptcha-response"});

            if (($recaptcha = json_decode($response)) && $recaptcha->success && $recaptcha->score >= 0.5) {
                return true;
            }

            return false;
        }

        return true;
    }
}
