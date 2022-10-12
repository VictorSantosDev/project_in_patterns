<?php

namespace Modules\Dashboard\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Modules\Dashboard\services\User\UserService;

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
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uriServe = $_SERVER['REQUEST_URI'];

        $uriExplode = explode('/', $uriServe);

        $uriToken = array_pop( $uriExplode);

        if(empty($uriToken) || $uriToken === '' || $uriToken === null){
            return redirect()->route('signin')->with('msg', 'Link quebrado, faça o reset de senha!');
        }
        
        if(!Cache::has('auth')){
            return redirect()->route('signin')->with('msg', 'Nessesário fazer o login novamente!');
        }

        $authCheck = $this->userService->authCheckMiddleware($uriToken);
        if(!$authCheck){
            return redirect()->route('signin')->with('msg', 'Usuário precisa confirmar o e-mail!');
        }

        Cache::put('auth', $uriToken, 6000);
        return $next($request);
    }
}
