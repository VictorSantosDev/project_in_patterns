<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Http\Requests\UserWalletRequest;
use Modules\Dashboard\services\UserWallet\UserWalletService;

class DashboardController extends Controller
{
    /** @var  UserWalletService */
    private $service;

    public function __construct(UserWalletService $userService)
    {
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard($token)
    {
        return view('dashboard::dashboard', [
            'token' => $token
        ]);
    }

    public function userWallet($token)
    {
        return view('dashboard::user-wallet', [
            'token' => $token
        ]);
    }

    public function importUserWallet(UserWalletRequest $request, $token)
    {
        dd('ok');
        dd($request->file('file_user_wallet'));
    }
}
