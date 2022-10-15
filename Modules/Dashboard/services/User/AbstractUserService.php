<?php

namespace Modules\Dashboard\services\User;

use Modules\Dashboard\Repositories\UserEloquent\UserRepository;

abstract class AbstractUserService
{
    /** @var UserRepository */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
