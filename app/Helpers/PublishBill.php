<?php

namespace App\Helpers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Role;
use Carbon\Carbon;

class PublishBill
{
    public function __invoke()
    {
         Bill::query()->where("month",date("m"))
             ->where("year",date("y"))
             ->where("published_at",null)
             ->update(["published_at"=>Carbon::now()]);
    }
}
