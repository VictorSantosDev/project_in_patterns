<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\User\AuthUserService;
use Illuminate\Support\Facades\Cache;

use Exception;

class AuthUserController extends Controller
{
    public function __construct(AuthUserService $authUserService)
    {
        $this->authUserService = $authUserService;
    }

    public function auth(Request $request)
    {
        $selectRoute = $this->authUserService->authUser($request);    

        if($selectRoute === 'not_verify'){
            return redirect()->route('signin')
                            ->with([
                                'msg' => 'Por favor ative sua conta!',
                                'not_active' => true
                            ]);
        }

        if($selectRoute === 'not_success'){
            return redirect()->route('signin')
                            ->with([
                                'msg' => 'Esse usuário não existe, por favor crie uam conta!',
                                'not_exist' => true
                            ]);
        }

        if($selectRoute === 'success'){
            return redirect()->route('app.dashboard', ['token' => Cache::get('auth')]);
        }
        
        throw new Exception('ERRO: Algo inesperado ocorreu na autenticação!');
    }

    public function checkAuthUser($token)
    {
        $verifyAuth = $this->authUserService->verifyAuth($token);

        if(!$verifyAuth){
            return redirect()->route('signin');
        }

        return redirect()->route('app.home', ['token', $token]);
    }
}
