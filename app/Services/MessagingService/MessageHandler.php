<?php

namespace App\Services\MessagingService;

use App\Services\MessagingService\Kavenegar\KavenegarService;

class MessageHandler
{
    const brookers = ["kavenegar"];
    public static function setBrooker(string $brooker,int $user_id, string $title, string $body, int $unit, int $bill_id)
    {

        if (!in_array($brooker,self::brookers)) {
            abort(403, "brooker is not valid");
        }elseif ($brooker == "kavenegar"){
            return new KavenegarService($user_id,$title,$body,$unit,$bill_id);
        }
    }
}
