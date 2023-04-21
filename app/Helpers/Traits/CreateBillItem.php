<?php

namespace App\Helpers\Traits;

use Illuminate\Database\Eloquent\Model;

trait CreateBillItem
{
    public function createBillItem(Model $model, int $user_id, int $bill_id)
    {
        $model->bill()->create([
            "user_id" => $user_id,
            "bill_id" => $bill_id,
            "total_cost" => $model->total_cost,
            "month" => date("m"),
            "year" => date("y")
        ]);
    }
}
