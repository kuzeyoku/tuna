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

    public function sendReply($request, Model $message)
    {
        try {
            Mail::to($message->email)->send(new ReplyMessage($request, $message));

            return $message->update([
                "status" => StatusEnum::Answered->value
            ]);
        } catch (\Exception $e) {
            Log::channel('custom_errors')->error($e->getMessage());
        }
    }
}
