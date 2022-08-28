<?php

namespace App\Service\User;

use Illuminate\Http\Request;
use App\Mail\verificationEmail;
use Exception;
use Illuminate\Support\Facades\Cache;
use \Illuminate\Support\Facades\Mail;

class UserService extends AbstractUserService
{

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function registerUser(Request $request): void
    {
        $request->validate($this->repository->rules(), $this->repository->feedback());

        if(!$this->validateEmail($request->email)){
            throw ['invalidEmail: ' => 'O e-mail não corresponde o padrão necessário!'];
        };

        if(!$this->emailDuplicate($request->email)){
            throw ['invalidEmail: ' => 'O e-mail já esta em uso por outro usuário!'];
        }

        if(!$this->validatePassword($request->password)) {
            throw ['invalidPassword: ' => 'A senha não corresponde ao padrão necessário!'];
        };

        $this->repository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'verify_email' => $this->generateHashVerify($request->email)
        ]);

        $this->sendEmail(
            'Sejá Bem-vindo ao NEXTBANK', 
            $request->email, 
            $request->name, 
            $this->generateHashVerify($request->email)
        );
    }

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private function sendEmail(
    string $message,
    string $email,
    string $name,
    string $verify_email
    ): void
    {
        // 'http://'.$_SERVER['HTTP_HOST'].'/verify/email/token/'.$verify_email
        $urlHttpHost = route('verify-email', ['token' => $verify_email]);

        $constructEmail = new verificationEmail(
            $message,
            $email,
            ucwords($name),
            $urlHttpHost
        );
        Mail::send($constructEmail);
    }

    public function generateHashVerify($email): string
    {
        $date = date('Y-m-d H:i:s');
        return hash("sha256", $email . $date);
    }

    public function verifyEmail($token)
    {
        $userVerifyEmail = $this->repository->where('verify_email', $token)->first();
        if(!$userVerifyEmail){
            return false; // if user not exist
        }

        $date = date('Y-m-d H:i:s');

        $hashAuthenticated = $this->hashAuthenticated(
            $userVerifyEmail->email, $date
        );

        try{
            $userVerifyEmail->email_verified_at = $date;
            $userVerifyEmail->verify_email = null;
    
            $userVerifyEmail->authenticated_token = $hashAuthenticated;
            $userVerifyEmail->save();
            Cache::put('auth', $hashAuthenticated);
            
            return Cache::get('auth'); // true or false
        }catch(Exception $e){
            throw new Exception('Houve algun ERRO na verificação do e-mail! - '.$e->getMessage());
        }
    }

    public function hashAuthenticated($email, $date)
    {
        $hashAuthenticated = hash('sha256', $email . $date);
        return $hashAuthenticated;
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
