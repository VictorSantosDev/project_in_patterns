<?php

namespace App\Repositories\Contract;

interface UserRepositoryInterface
{
    public function all();

    public function rules();

    public function feedback();

    public function create($dados);
}
