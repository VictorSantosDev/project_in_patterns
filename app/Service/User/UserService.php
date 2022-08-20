<?php

namespace App\Service\User;

use Illuminate\Http\Request;

class UserService extends AbstractUserService
{
    
    public function registerUser(Request $request): void
    {
        $request->validate($this->repository->rules(), $this->repository->feedback());

        if(!$this->validateEmail($request->email)){
            throw ['invalidEmail: ' => 'O e-mail não corresponde o padrão necessário!'];
        };

        if(!$this->emailDuplicate($request->email)){
            throw ['invalidEmail: ' => 'O e-mail já esta em uso por outro usuário!'];
        }

        if(!$this->validatePassword($request->password)) {
            throw ['invalidPassword: ' => 'A senha não corresponde o padrão necessário!'];
        };

        $this->repository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password)
        ]);
    }
}
