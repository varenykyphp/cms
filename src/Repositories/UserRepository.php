<?php

namespace Varenyky\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    /**
     * To initialize class objects/variable.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
