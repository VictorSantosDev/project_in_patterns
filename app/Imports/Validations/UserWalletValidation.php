<?php

namespace App\Imports\Validations;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class UserWalletValidation
{
    public function validateYear($value): bool
    {
        if($value > Carbon::now()->format('Y')){
            throw new Exception(Cache::get('countLineProsse'));
        }

        if(!ctype_digit($value)){
            throw new Exception(Cache::get('countLineProsse'));
        }
        
        return true;
    }

    public function validateMonth($value): bool
    {
        if($value > Carbon::now()->format('m')){
            throw new Exception(Cache::get('countLineProsse'));
        }

        if(!ctype_digit($value)){
            throw new Exception(Cache::get('countLineProsse'));
        }
        
        return true;
    }

    public function validateName($value): bool
    {
        if(filter_var($value, FILTER_SANITIZE_NUMBER_INT) != ''){
            throw new Exception(Cache::get('countLineProsse'));
        }

        return true;
    }

    public function validateCpf($value): bool
    {
        if(!ctype_digit($value)){
            throw new Exception(Cache::get('countLineProsse'));
        }

        Cache::put('countLineProsse', Cache::get('countLineProsse') + 1);
        return true;
    }
}
