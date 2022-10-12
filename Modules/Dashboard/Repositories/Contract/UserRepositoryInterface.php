<?php

namespace Modules\Dashboard\Repositories\Contract;

interface UserRepositoryInterface
{
    public function all();
    
    public function where($key, $value);
}
