<?php

namespace Modules\Dashboard\Repositories\UserWalletEloquent;

use Modules\Dashboard\Entities\UserWallet;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(UserWallet $model)
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
