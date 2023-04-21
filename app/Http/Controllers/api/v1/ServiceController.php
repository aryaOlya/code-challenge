<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\MyHelpers;
use App\Helpers\Traits\CreateBillItem;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StoreServiceRequest;
use App\Jobs\NotifJob;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Service;
use App\Models\ServiceLog;
use App\Repositories\Bill\BillRepository;
use App\Repositories\ServiceLog\ServiceLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends ApiController
{
    use CreateBillItem;

    protected BillRepository $billRepository;
    protected ServiceLogRepository $serviceLogRepository;

    public function __construct(BillRepository $billRepository,ServiceLogRepository $serviceLogRepository)
    {
        $this->billRepository = $billRepository;
        $this->serviceLogRepository = $serviceLogRepository;
    }

    public function allBillItems(){

       $billItems = Bill::query()->where("user_id",auth()->user()->id)->first()->billItems;
       $totalCost = $billItems->sum("total_cost");

       return $this->success(["items"=>$billItems,"total_cost"=>$totalCost],200,"all items that your bill will be have");
    }

    public function allPublishedBills(){
        $bills = Bill::query()->with("billItems")
            ->where("user_id",auth()->user()->id)
            ->where("published_at","!=",null)
            ->get();
        return $this->success($bills,200,"all the bills with their items");
    }

    public function currentMonthBills(){
        $bills = Bill::query()->with("billItems")
            ->where("user_id",auth()->user()->id)
            ->where("published_at","!=",null)
            ->where("month",date("m"))
            ->where("year",date("y"))
        ;

        if ($bills->count() == 0)
            return $this->success($bills,200,"this month bill has not been published yet");

        $bills = $bills->get();

        return $this->success($bills,200,"all the bills with their items");
    }

    public function specificDate(int $year, int $month)
    {
        $bills = Bill::query()->with("billItems")
            ->where("user_id",auth()->user()->id)
            ->where("published_at","!=",null)
            ->where("month",$month)
            ->where("year",$year);


        if ($bills->count() == 0)
            return $this->success($bills,200,"the date you choose has no published bill ");

        $bills = $bills->get();

        return $this->success($bills,200,"all the bills with their items for date you choose");
    }


    public function store(StoreServiceRequest $request)
    {
        $service = Service::query()->where("id",$request->service_id)->first();
        $totalCost = $request->unit * $service->cost_per_unit;
        $currentMonthBillNum = Bill::query()->where("month",date("m"))->where("year",date("y"))->count();
        $bill_id = null;

        try {
            DB::beginTransaction();
            if ($currentMonthBillNum != 0){
                $currentMonthBill = Bill::query()->where("month",date("m"))
                    ->where("year",date("y"))
                    ->first();
                $newTotalCost = $currentMonthBill->total_cost + $totalCost;
                $bill_id = $currentMonthBill->id;

                $this->billRepository->update($currentMonthBill,[
                    "total_cost"=>$newTotalCost
                ]);
            }elseif ($currentMonthBillNum == 0){
                $bill = $this->billRepository->create([
                    "user_id" => auth()->user()->id,
                    "total_cost" => $totalCost,
                    "month" => date("m"),
                    "year" => date("y")
                ]);

                $bill_id = $bill->id;
            }


            $serviceLog = $this->serviceLogRepository->create([
                "user_id"=>auth()->user()->id,
                "service_id"=>$request->service_id,
                "unit"=>$request->unit,
                "total_cost"=>$totalCost,
                "month"=>date("m"),
                "year"=>date("y")
            ]);

            $this->createBillItem($serviceLog,auth()->user()->id,$bill_id);

            DB::commit();

            NotifJob::dispatch("kavenegar","title","body",auth()->user()->id,10,$bill_id);

            return $this->success($serviceLog,201,"service log created successfully!");

        }catch (\Exception){
            DB::rollBack();
        }

    }
}
























