<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\User\UserService;

class RegisterController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return view('login.register', [
            'request' => $request
        ]);
    }

    public function signin()
    {
        return view('login.signin');
    }

    public function register(Request $request)
    {
        $this->userService->registerUser($request);

        return redirect()->route('signin')->with('msg', 'Cadastro realizado com sucesso!');
    }

    public function resetPassword()
    {
        return view('login.reset-password');
    }

    public function resetPasswordUser(Request $request)
    {
        $this->userService->resetPasswordUser($request);
        return redirect()
                ->route('signin')
                ->with('msg', 'E-mail enviado para resete de senha!');
    }

    public function verifyEmail($token)
    {
        $tokenUser = $this->userService->verifyEmail($token);

        if(!$tokenUser)
        {
            return redirect()->route('signin');
        }

        return redirect()->route('check-auth', [
            'token' => $tokenUser
        ]);
    }

    public function resetNewPassword($hash)
    {
        $verifyResetHash = $this->userService->verifyHashResetPassword($hash);

        return  $verifyResetHash
                ? view('login.new-password', ['hash' => $hash])
                : redirect()
                ->route('signin')
                ->with('msg', 'Token inválido para resetar senha!');
    }

    public function resetNewPasswordUser(Request $request, $hash)
    {
        $verifyUserForReset = $this->userService->verifyUserForReset($request, $hash);
        
        return  redirect()
                ->route('signin')
                ->with('msg', 'Senha alterada com successo! efetue o login.');
    }
}
