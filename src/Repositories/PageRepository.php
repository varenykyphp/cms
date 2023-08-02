<?php

namespace Varenyky\Repositories;

use Varenyky\Models\Page\Page;

class PageRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->where('id', $id);
    }
}
