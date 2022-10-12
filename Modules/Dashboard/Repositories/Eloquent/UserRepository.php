<?php

namespace Modules\Dashboard\Repositories\Eloquent;

use Modules\Dashboard\Entities\User;
use Modules\Dashboard\Repositories\Contract\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;
}
