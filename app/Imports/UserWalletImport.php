<?php

namespace App\Imports;

use Exception;
use App\Models\UserWallet;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Jobs\UserWallet as UserWalletJob;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Imports\Validations\UserWalletValidation;
use Modules\Dashboard\Entities\LogUserWalletFailed;

class UserWalletImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow, ShouldQueue, WithChunkReading
{
    use Importable;

    /** @var string */
    const YEAR = 'year';

    /** @var string */
    const MONTH = 'month';

    /** @var string */
    const NAME = 'name';

    /** @var string */
    const CPF = 'cpf';

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
            self::YEAR => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateYear((string) $value);
            },

            self::MONTH => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateMonth((string) $value);
            },
             
            self::NAME => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateName((string) $value);
            },

            self::CPF => function($attribute, $value, $onFailure) {
                $validate = new UserWalletValidation;
                $validate->validateCpf((string) $value);
            },
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
