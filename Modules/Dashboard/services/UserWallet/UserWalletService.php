<?php

namespace Modules\Dashboard\services\UserWallet;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendImporFileCsv;
use Illuminate\Support\Facades\Storage;

class UserWalletService extends AbstractUserWallet
{
    public function getAll(){
        return $this->repository->all();
    }
    public function imporFileCsv($request): void
    {
        $path = Storage::disk('local')->put(
            'userWallet', $request->file('file_user_wallet')
        );
        SendImporFileCsv::dispatch($path);
    }

    // public function imporFileCsv($request): void
    // {
    //     $fileOpen = fopen($request->file('file_user_wallet'), 'r');

    //     $count = 1;

    //     while($file = fgetcsv($fileOpen, 0, ';')){

    //         if($count == 1){
    //             $count++;
    //             continue;
    //         }

    //         $dataFile = [
    //             'year'  =>  $this->validatedYear($file[0], $count),
    //             'month' =>  $this->validatedMonth($file[1], $count),
    //             'name'  =>  $this->validatedName($file[2], $count),
    //             'cpf'   =>  $this->validatedCpf($file[3], $count),
    //         ];

            // echo '<pre>';
            // print_r($dataFile);
            // echo '<pre>';
            // dispatch / $dataFile for job here

    //         $count++;
    //     }
    // }

    // private function validatedYear(string $year, int $line): int
    // {
    //     try{
    //         return (int) $year;
    //     }catch(Exception $e){
    //         throw new Exception("A coluna 'year' deve ser do tipo numerica, erro linha: $line do arquivo");
    //     }
    // }

    // private function validatedMonth(string $month, int $line): int
    // {
    //     try{
    //         return (int) $month;
    //     }catch(Exception $e){
    //         throw new Exception("A coluna 'month' deve ser do tipo numerica, erro linha: $line do arquivo");
    //     }
    // }

    // private function validatedName(string $name, int $line): string
    // {
    //     try{
    //         if(!filter_var($name, FILTER_SANITIZE_NUMBER_INT)){
    //             return (string) $name;
    //         }
    //     }catch(Exception $e){
    //         throw new Exception("A coluna 'name' deve ser do tipo texto, erro linha: $line do arquivo");
    //     }
    // }

    // private function validatedCpf(string $cpf, int $line): int
    // {
    //     $removePoint = Str::replace('.', '', $cpf);

    //     $removeTrace = Str::replace('-', '', $removePoint);

    //     $cpfNumber = (int) $removeTrace;

    //     $cpf = Validator::make(
    //         ['cpf' => $cpfNumber],
    //         ['cpf' => 'required|cpf']
    //     );

    //     if (strlen($cpfNumber) != 11) {
    //         throw new Exception("CPF deve conter no maximo 11 digitios e no minimo 11 digitos, erro linha: $line do arquivo");
    //     }

    //     if($cpf->fails()){
    //         throw new Exception("CPF est?? inv??lido, erro na linha: $line do arquivo");
    //     }

    //     return $cpfNumber;
    // }
}
