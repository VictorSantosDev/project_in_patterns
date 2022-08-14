<?php

namespace App\Repositories\Eloquent;

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

    public function rules()
    {
        return $this->model->rules();
    }

    public function feedback()
    {
        return $this->model->feedback();
    }
    
    public function create($dados)
    {
        $this->model->create($dados);
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
