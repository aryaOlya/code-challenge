<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{

    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $columns)
    {
        return $this->model->query()->create($columns);
    }

    public function update(Model $model, array $columns): bool
    {
        return $model->update($columns);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }
}
