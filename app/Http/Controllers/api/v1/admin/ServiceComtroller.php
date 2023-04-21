<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\admin\StoreService;
use App\Http\Requests\api\v1\admin\UpdateService;
use App\Models\Service;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Http\Request;

class ServiceComtroller extends ApiController
{

    protected ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        //
    }


    public function store(StoreService $request)
    {

        $service = $this->serviceRepository->create([
            "name" => $request->name,
            "description" => $request->description,
            "unit_name" => $request->unit_name,
            "cost_per_unit" => $request->cost_per_unit
        ]);

        return $this->success($service, 201, 'service ' . $service->name . " created successfully!");
    }



    public function update(UpdateService $request, string $id)
    {
        $service = Service::query()->find($id);

        $this->serviceRepository->update($service,[
            "name"=>$request->name,
            "description"=>$request->description,
            "unit_name"=>$request->unit_name,
            "cost_per_unit"=>$request->cost_per_unit
        ]);

        return $this->success($service,201,"service updated successfully!");
    }


    public function destroy(string $id)
    {
       $service = Service::query()->find($id);
       $this->serviceRepository->delete($service);
        return $this->success(null,200,"service deleted successfully!");
    }
}
