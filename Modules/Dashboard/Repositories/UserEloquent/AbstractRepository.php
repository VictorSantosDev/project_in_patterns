<?php

namespace Modules\Dashboard\Repositories\UserEloquent;

use Modules\Dashboard\Entities\User;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function all()
    {
        return $this->model->all();
    }
    
    public function where($key, $value)
    {
        return $this->model->where($key, $value);
    }
}
