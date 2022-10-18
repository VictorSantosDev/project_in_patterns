<?php

namespace App\Imports\Validations;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Modules\Dashboard\Entities\LogUserWalletFailed;

class UserWalletValidation
{
    public function validateYear($value): bool
    {
        if($value > Carbon::now()->format('Y')){
            LogUserWalletFailed::create([
                'title' => 'Year',
                'description' => "Falha na linha ".Cache::get('countLineProsse') + 1 
            ]);

            throw new Exception(Cache::get('countLineProsse') + 1);
        }

        if(!ctype_digit($value)){
            LogUserWalletFailed::create([
                'title' => 'Year',
                'description' => "Falha na linha ".Cache::get('countLineProsse') + 1 
            ]);

            throw new Exception(Cache::get('countLineProsse') + 1);
        }
        
        return true;
    }

    public function validateMonth($value): bool
    {
        if($value > Carbon::now()->format('m')){
            LogUserWalletFailed::create([
                'title' => 'Month',
                'description' => "Falha na linha ".Cache::get('countLineProsse') + 1 
            ]);
            throw new Exception(Cache::get('countLineProsse') + 1);
        }

        if(!ctype_digit($value)){
            LogUserWalletFailed::create([
                'title' => 'Month',
                'description' => "Falha na linha ".Cache::get('countLineProsse') + 1 
            ]);
            throw new Exception(Cache::get('countLineProsse') + 1);
        }
        
        return true;
    }

    public function validateName($value): bool
    {
        if(filter_var($value, FILTER_SANITIZE_NUMBER_INT) != ''){
            LogUserWalletFailed::create([
                'title' => 'Name',
                'description' => "Falha na linha ".Cache::get('countLineProsse') + 1 
            ]);
            throw new Exception(Cache::get('countLineProsse') + 1);
        }

        return true;
    }

    public function validateCpf($value): bool
    {
        if(!ctype_digit($value)){
            LogUserWalletFailed::create([
                'title' => 'Cpf',
                'description' => "Falha na linha ".Cache::get('countLineProsse') + 1 
            ]);
            throw new Exception(Cache::get('countLineProsse') + 1);
        }

        Cache::put('countLineProsse', Cache::get('countLineProsse') + 1);
        return true;
    }
}
