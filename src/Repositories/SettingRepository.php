<?php

namespace Varenyky\Repositories;

use Varenyky\Models\Setting\Setting;

class SettingRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
}
