<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contract\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;
}
