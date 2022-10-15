<?php

namespace Modules\Dashboard\services\UserWallet;

class UserWalletService extends AbstractUserWallet
{
    public function getAll(){
        return $this->repository->all();
    }
}
