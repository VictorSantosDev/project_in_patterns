<?php

namespace Modules\Dashboard\services\UserWallet;

use Modules\Dashboard\Repositories\UserWalletEloquent\UserWalletRepository;

class AbstractUserWallet
{
    /** @var UserWalletRepository */
    protected $repository;

    public function __construct(UserWalletRepository $repository)
    {
        $this->repository = $repository;
    }
}
