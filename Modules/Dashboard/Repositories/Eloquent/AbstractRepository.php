<?php

namespace Modules\Dashboard\Repositories\Eloquent;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }
    
    public function all()
    {
        return $this->model->all();
    }
    
    public function where($key, $value)
    {
        return $this->model->where($key, $value);
    }
    
    protected function resolveModel()
    {
        return app($this->model);
    }
}
