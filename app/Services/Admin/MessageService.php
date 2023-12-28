<?php

namespace App\Services\Admin;

use App\Models\Message;
use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Mail\Admin\ReplyMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class MessageService extends BaseService
{
    public function __construct(Message $message)
    {
        parent::__construct($message, ModuleEnum::Message);
    }

    public function statusUpdate(Model $message)
    {
        $data = new Request([
            "status" => StatusEnum::Read->value
        ]);

        parent::update($data, $message);
    }

    public function sendReply(Request $request)
    {
        try {
            $message = Message::findOrFail($request->message_id);

            $this->setMailSettings();

            Mail::send(new ReplyMessage($request, $message->name));

            $message->update([
                "status" => StatusEnum::Answered->value
            ]);
            return true;
        } catch (\Exception $e) {
            Log::channel('custom_errors')->error($e->getMessage());
        }
    }

    public function setMailSettings()
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
