<?php

namespace App\Service\User;

use Illuminate\Http\Request;
use App\rules\RulesAndFeedBacks;

class AuthUserService extends AbstractUserService
{
    const AUTH_SUCCESS = 'success';
    const AUTH_NOT_SUCCESS = 'not_success';
    const AUTH_NOT_VERIFY = 'not_verify';

    public function authUser(Request $request)
    {
        $rulesAndFeedBacks = new RulesAndFeedBacks;
        $request->validate($rulesAndFeedBacks->authUserRules(), $rulesAndFeedBacks->authUserFeedback());
        
        /**
        * description: verifica se usuário existe
        */
        if($this->userExists($request)){
            return self::AUTH_NOT_SUCCESS;
        }

        /**
        * description: verifica se já verificou a conta
        */
        if($this->verifyUser($request)){
            return self::AUTH_NOT_VERIFY;
        }

        /**
        * description: gera o token do usuário para manter logado (PENDENTE EM DEV)
        */
        dd(self::AUTH_SUCCESS);
        return self::AUTH_SUCCESS;
    }

    private function verifyUser($request): bool
    {
        $verifyUser = $this->repository
            ->where('email', $request->email)
            ->where('password', md5($request->password))
            ->whereNotNull('email_verified_at')
        ->first();
        return $verifyUser === null;
    }

    private function userExists($request): bool
    {
        $verifyUser = $this->repository
            ->where('email', $request->email)
            ->where('password', md5($request->password))
        ->first();

        return $verifyUser === null;
    }

    public function generateToken()
    {
        // aguardando logica de verificação de email...
    }
}
