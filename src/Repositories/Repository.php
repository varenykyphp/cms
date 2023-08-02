<?php

namespace Varenyky\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * To get all records for particular entity.
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getAllPaginated($paginate = 25)
    {
        return $this->model->paginate($paginate);
    }

    /**
     * To get specific records for particular entity.
     */
    public function whereIn(string $field, array $values = []): Collection
    {
        return $this->model->whereIn($field, $values)->get();
    }

    /**
     * To update existing or create new entity.
     */
    public function updateOrCreate(array $where, array $update): Model
    {
        return $this->model
            ->updateOrCreate($where, $update);
    }

    /**
     * To delete model by providing specific conditions.
     */
    public function deleteWhere(array $where): bool
    {
        return $this->model->where($where)->delete();
    }

    /**
     * To insert the multiple row's at a time.
     */
    public function bulkInsert(array $data): bool
    {
        return $this->model->insert($data);
    }

    /**
     * To update the particular record.
     */
    public function update(int $id, array $attributes): bool
    {
        return $this->model->where('id', $id)->update($attributes);
    }

    public function create(array $create): Model
    {
        return $this->model
            ->create($create);
    }

    /**
     * To delete model by providing specific ids & key to check with.
     */
    public function deleteWhereInIds(array $ids, string $idKey = 'id'): mixed
    {
        return $this->model->whereIn($idKey, $ids)->delete();
    }
}
