<?php

namespace App\Service\User;

use Illuminate\Http\Request;
use App\Repositories\Contract\UserRepositoryInterface;

class UserService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function registerUser(Request $request): void
    {    
        if(!$this->validateEmail($request->email)){
            throw ['invalidEmail: ' => 'O e-mail não corresponde o padrão necessário!'];
        };

        if(!$this->validatePassword($request->password)) {
            throw ['invalidPassword: ' => 'A senha não corresponde o padrão necessário!'];
        };

        $request->validate($this->repository->rules(), $this->repository->feedback());

        $this->repository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password)
        ]);
    }

    public function validatePassword($password): bool
    {
        $regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/";
        $validate = preg_match($regex, $password);

        if($validate){
            return true;
        }

        return false;
    }

    public function validateEmail($email): bool
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }

        return false;
    }
}
