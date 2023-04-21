<?php

namespace App\Jobs;

use App\Models\Role;
use App\Services\MessagingService\MessageHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Scalar\String_;

class NotifJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private String $brooker;
    private string $title;
    private string $body;
    private int $user_id;
    private int $unit;
    private int $bill_id;

    public function __construct(string $brooker,string $title, string $body, int $user_id, int $unit,int $bill_id)
    {
        $this->brooker = $brooker;
        $this->title = $title;
        $this->body = $body;
        $this->user_id = $user_id;
        $this->unit = $unit;
        $this->bill_id = $bill_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//       $messageHandler =  MessageHandler::setBrooker($this->brooker);
//       $messageHandler->sendNotif();
//       $messageHandler->saveLog("title","body",auth()->user()->id,"30");

        $sendMessage = MessageHandler::setBrooker($this->brooker,$this->user_id,$this->title,$this->body,$this->unit,$this->bill_id);
        $sendMessage->saveLog();




    }
}
