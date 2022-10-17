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
use Illuminate\Support\Facades\Cache;

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
                $validate->validateYear((string) $value);
            },

            'month' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateMonth((string) $value);
            },
             
            'name' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateName((string) $value);
            },

            'cpf' => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateCpf((string) $value);
            },
        ];
    }
}
