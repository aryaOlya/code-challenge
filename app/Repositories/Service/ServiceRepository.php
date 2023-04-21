<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ServiceRepository extends BaseRepository
{
    public function __construct(Service $model)
    {
        $this->model = $model;
    }
}
