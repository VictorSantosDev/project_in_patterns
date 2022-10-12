<?php

namespace Modules\Dashboard\services\User;

use Illuminate\Support\Facades\Cache;

class UserService extends AbstractUserService
{
    public function getAll()
    {
        return $this->repository->all();
    }

    public function authCheckMiddleware($token)
    {
        $checkUser = '';
        
        if(!Cache::has('auth')){
            return false;
        }

        if(Cache::get('auth') != $token){
            return false;
        }

        $checkUser = $this->repository->where('authenticated_token', $token)
                                        ->whereNotNull('email_verified_at')
                                        ->first();
        
        return !empty($checkUser);
    }
}
