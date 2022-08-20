<?php

namespace App\Service\User;

use App\Repositories\Contract\UserRepositoryInterface;

abstract class AbstractUserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function validatePassword($password): bool
    {
        $regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/";
        $validate = preg_match($regex, $password);

        if($validate){
            return true;
        }

        return false;
    }

    protected function validateEmail($email): bool
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }

        return false;
    }

    protected function emailDuplicate($email): bool
    {
        if($this->repository->where('email', $email)->first() === null){
            return true;
        }

        return false;
    }
}
