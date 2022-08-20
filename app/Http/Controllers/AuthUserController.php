<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\User\AuthUserService;

class AuthUserController extends Controller
{
    public function __construct(AuthUserService $authUserService)
    {
        $this->authUserService = $authUserService;
    }

    public function auth(Request $request)
    {
        $this->authUserService->authUser($request);
        return ;
    }
}
