<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Service\User\UserService;

class AuthMiddleware
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tokenUrl = '';

        if(!isset(array_keys($_GET)[0])){
            dd($_GET);
            return redirect()->route('signin')->with('msg', 'Link quebrado, faça o reset de senha!');
        }

        $tokenUrl = array_keys($_GET)[0];
        
        if(!Cache::has('auth')){
            return redirect()->route('signin')->with('msg', 'Nessesário fazer o login novamente!');
        }

        $authCheck = $this->userService->authCheckMiddleware($tokenUrl);
        if(!$authCheck){
            return redirect()->route('signin')->with('msg', 'Usuário precisa confirmar o e-mail!');
        }

        Cache::put('auth', $tokenUrl, 6000);
        return $next($request);
    }
}
