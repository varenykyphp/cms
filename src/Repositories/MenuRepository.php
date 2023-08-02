<?php

namespace Varenyky\Repositories;

use Varenyky\Models\Menu\Menu;

class MenuRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
}
