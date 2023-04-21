<?php

namespace App\Services\MessagingService\Kavenegar;

use App\Helpers\Traits\CreateBillItem;
use App\Http\Controllers\api\ApiController;
use App\Models\Bill;
use App\Models\Brooker;
use App\Models\MessageLog;
use App\Services\MessagingService\MessagingServiceInterface;
use Illuminate\Support\Facades\DB;

class KavenegarService implements MessagingServiceInterface
{
    use CreateBillItem;

    const name = "kavenegar";

    private int $user_id;
    private string $title;
    private string $body;
    private int $unit;
    private int $bill_id;

    public function  __construct(int $user_id, string $title, string $body, int $unit, int $bill_id)
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->body = $body;
        $this->unit = $unit;
        $this->bill_id = $bill_id;
    }


    public function sendNotif()
    {
        //
    }

    public function saveLog()
    {
        $brooker = Brooker::query()->where("name",self::name)->first();
        $totalCum = $this->unit * $brooker->cost_per_unit;

        try {
            DB::beginTransaction();
            $messageLog = MessageLog::query()->create([
                "user_id"=>$this->user_id,
                "brooker_id"=>$brooker->id,
                "title"=>$this->title,
                "body"=>$this->body,
                "unit"=>$this->unit,
                "total_cost"=>$totalCum
            ]);

            $this->createBillItem($messageLog,auth()->user()->id,$this->bill_id);

            $currentBill = Bill::query()->where("id",$this->bill_id)->first();
            $newCost = $currentBill->total_cost + $totalCum;
            $currentBill->update(["total_cost"=>$newCost]);

            DB::commit();

        }catch (\Exception){
            DB::rollBack();
        }
    }
}



























