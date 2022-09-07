<?php

namespace App\Service\User;

use Illuminate\Http\Request;
use App\rules\RulesAndFeedBacks;
use Illuminate\Support\Facades\Cache;

class AuthUserService extends AbstractUserService
{
    const AUTH_SUCCESS = 'success';
    const AUTH_NOT_SUCCESS = 'not_success';
    const AUTH_NOT_VERIFY = 'not_verify';

    public function authUser(Request $request)
    {
        $rulesAndFeedBacks = new RulesAndFeedBacks;
        $request->validate(
            $rulesAndFeedBacks->authUserRules(), $rulesAndFeedBacks->authUserFeedback()
        );
        
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
        $token = $this->generateTokenAccess($request->email);
        $this->authUserNow($request, $token);
        return self::AUTH_SUCCESS;
    }

    private function verifyUser($request): bool
    {
        $verifyUser = $this->repository
            ->where('email', $request->email)
            ->where('password', md5($request->password))
            ->whereNotNull('email_verified_at')
            ->whereNull('verify_email')
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

    public function verifyAuth($token)
    {
        if(!Cache::has('auth')){
            return false;
        }
        if(Cache::get('auth') != $token){
            Cache::forget('auth');
            return false;
        }

        return Cache::has('auth') AND Cache::get('auth') === $token;
    }

    public function generateTokenAccess($email)
    {
        $date = date('Y-m-d H:i:s');
        return hash("sha256", $email . $date);
    }

    public function authUserNow($request, $token)
    {
        $authUser = $this->repository
                        ->where('email', $request->email)
                        ->where('password', md5($request->password))
                        ->first();

        $authUser->authenticated_token = $token;
        Cache::put('auth', $token, 6000);
        $authUser->save();
    }
}
