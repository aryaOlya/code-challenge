<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $columns);

    public function update(Model $model, array $columns);

    public function delete(Model $model);

}
