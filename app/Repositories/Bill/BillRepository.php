<?php

namespace App\Repositories\Bill;

use App\Models\Bill;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class BillRepository extends BaseRepository
{
    public function __construct(Bill $model)
    {
       $this->model = $model;
    }
}
