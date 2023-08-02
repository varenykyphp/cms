<?php

namespace Varenyky\Repositories;

use Varenyky\Models\Menu\MenuItem;

class MenuItemRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(MenuItem $model)
    {
        $this->model = $model;
    }
}
