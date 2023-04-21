<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\Controller;
use App\Jobs\NotifJob;
use App\Models\Bill;
use App\Models\Setting;
use App\Models\User;
use App\Services\MessagingService\MessageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends ApiController
{
    public function index()
    {
        $setting = Setting::query()->first();

        return $this->success($setting,200,"index page");

    }


}
