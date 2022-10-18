<?php

namespace Modules\Dashboard\Repositories\LogUserWalletFailedEloquent;

use Modules\Dashboard\Entities\LogUserWalletFailed;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(LogUserWalletFailed $model)
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

    public function store(array $value)
    {
        $this->model->create($value);
        $this->model->save();
    }
}
