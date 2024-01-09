<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
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
            Mail::to(config("setting.contact.email"))
                ->send(new Contact($request));

            $data = array_merge($request->validated(), ["user_agent" => $request->userAgent(), "ip" => $request->ip()]);

            Message::create($data);
            return back()
                ->withSuccess(__("front/contact.send_success"));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
                ->withInput()
                ->withError(__("front/contact.send_error"));
        }
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
}
