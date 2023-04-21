<?php

namespace App\Repositories\ServiceLog;

use App\Models\ServiceLog;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ServiceLogRepository extends BaseRepository
{
    public function __construct(ServiceLog $model)
    {
        $this->model = $model;
    }
}
