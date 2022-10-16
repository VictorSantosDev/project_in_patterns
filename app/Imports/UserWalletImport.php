<?php

namespace App\Imports;

use App\Models\UserWallet;
use App\Imports\Validations\UserWalletValidation;
use Exception;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UserWalletImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($this->countLineProsse > 0){
            $this->countLineProsse;
        }

        return new UserWallet([
            'year' => $row['year'],
            'month' => $row['month'],
            'name' => $row['name'],
            'cpf' => $row['cpf'],
        ]);
    }

    public function rules(): array
    {
        return [
            'year' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateYear($value);
            },

            'month' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateMonth($value);
            },
             
            'name' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateName($value);
            },

            'cpf' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateCpf($value);
            },
        ];
    }
}
