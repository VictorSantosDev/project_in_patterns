<?php

namespace App\Imports\Validations;

use Exception;
use Illuminate\Support\Carbon;

class UserWalletValidation
{
    private $countLineProsse = 0;

    public function validateYear($value): bool
    {
        if($value > Carbon::now()->format('Y')){
            throw new Exception('não é possivel inserir anos acima do ano atual');
        }

        if(!ctype_digit($value)){
            throw new Exception('o ano não é numerico');
        }
        
        return true;
    }

    public function validateMonth($value): bool
    {
        if($value > Carbon::now()->format('m')){
            throw new Exception('não é possivel inserir mês acima do mês atual');
        }

        if(!ctype_digit($value)){
            throw new Exception('o mês não é numerico');
        }
        
        return true;
    }

    public function validateName($value): bool
    {
        if(filter_var($value, FILTER_SANITIZE_NUMBER_INT) != ''){
            throw new Exception('nome inválido, contem numeros');
        }

        return true;
    }

    public function validateCpf($value): bool
    {
        if(!ctype_digit($value)){
            throw new Exception('o cpf não é numerico');
        }
        $this->countLineProsse += 1;
        return true;
    }
}
