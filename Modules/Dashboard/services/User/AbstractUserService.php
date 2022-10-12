<?php

namespace Modules\Dashboard\services\User;

use Modules\Dashboard\Repositories\Contract\UserRepositoryInterface;

abstract class AbstractUserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
