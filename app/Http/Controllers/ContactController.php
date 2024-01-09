<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{

    public function index()
    {
        return view('contact');
    }

    public function send(ContactRequest $request)
    {
        if (!$this->recaptcha($request)) {
            return back()
                ->withInput()
                ->withError(__("front/contact.recaptcha_error"));
        }

        try {
            $this->setMailSettings();
            Mail::to("yuceloglu1848@gmail.com")
                ->send(new \App\Mail\Contact($request->validated()));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        $data = array_merge($request->validated(), ["user_agent" => $request->userAgent(), "ip" => $request->ip()]);

        if (Message::Create($data)) {
            return back()
                ->withSuccess(__("front/contact.send_success"));
        }

        return back()
            ->withInput()
            ->withError(__("front/contact.send_error"));
    }

    private function recaptcha($request)
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

    private function setMailSettings()
    {
        config([
            "mail.mailers.smtp.host" => config("setting.smtp_host", env('MAIL_HOST')),
            "mail.mailers.smtp.port" => config("setting.smtp_port", env('MAIL_PORT')),
            "mail.mailers.smtp.encryption" => config("setting.smtp_encryption", env('MAIL_ENCRYPTION')),
            "mail.mailers.smtp.username" => config("setting.smtp_username", env('MAIL_USERNAME')),
            "mail.mailers.smtp.password" => config("setting.smtp_password", env('MAIL_PASSWORD')),
        ]);
    }
}
