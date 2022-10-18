<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Imports\UserWalletImport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\Dashboard\Entities\LogUserWalletFailed;
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
        try{
            DB::table('users_wallet')->truncate();
            Excel::import(new UserWalletImport, $request->file('file_user_wallet'));
            
            if(Cache::has('countLineProsse')){
                Cache::forget('countLineProsse');
            }

            return redirect()->route('app.dashboard', [
                'token' => $token
                ])->with('success', 'Arquivo enviado!');

        }catch(Exception $e){
            
            if(Cache::has('countLineProsse')){
                Cache::forget('countLineProsse');
            }

            return redirect()->route('app.dashboard', [
                'token' => $token
                ])->with('error', "Falha na importação, linha: {$e->getMessage()} invalidas!");
        }
    }
}
