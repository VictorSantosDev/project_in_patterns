<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Storage;

class SendImporFileCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var int */
    const COUNT = 1;
    
    /** @var string */
    public $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pathFile = $this->getPath();

        $fileOpen = fopen($pathFile, 'r');

        $count = self::COUNT;
    
        while($row = fgetcsv($fileOpen, 0, ';')){
            if($count == self::COUNT){
                $count++;
                continue;
            }

            $dataFile = [
                'year'  =>  $this->validatedYear($row[0], $count),
                'month' =>  $this->validatedMonth($row[1], $count),
                'name'  =>  $this->validatedName($row[2], $count),
                'cpf'   =>  $this->validatedCpf($row[3], $count),
            ];

            UserWallet::create($dataFile);

            $count++;
        }

        Storage::disk('local')->delete($this->path);
    }

    private function validatedYear(string $year, int $line): int
    {
        try{
            return (int) $year;
        }catch(Exception $e){
            throw new Exception("A coluna 'year' deve ser do tipo numerica, erro linha: $line do arquivo");
        }
    }

    private function validatedMonth(string $month, int $line): int
    {
        try{
            return (int) $month;
        }catch(Exception $e){
            throw new Exception("A coluna 'month' deve ser do tipo numerica, erro linha: $line do arquivo");
        }
    }

    private function validatedName(string $name, int $line): string
    {
        try{
            if(!filter_var($name, FILTER_SANITIZE_NUMBER_INT)){
                return (string) $name;
            }
        }catch(Exception $e){
            throw new Exception("A coluna 'name' deve ser do tipo texto, erro linha: $line do arquivo");
        }
    }

    private function validatedCpf(string $cpf, int $line): int
    {
        $removePoint = Str::replace('.', '', $cpf);

        $removeTrace = Str::replace('-', '', $removePoint);

        $cpfNumber = (int) $removeTrace;

        $cpf = Validator::make(
            ['cpf' => $cpfNumber],
            ['cpf' => 'required|cpf']
        );

        if (strlen($cpfNumber) != 11) {
            throw new Exception("CPF deve conter no maximo 11 digitios e no minimo 11 digitos, erro linha: $line do arquivo");
        }

        if($cpf->fails()){
            throw new Exception("CPF está inválido, erro na linha: $line do arquivo");
        }

        return $cpfNumber;
    }

    private function getPath()
    {
        return Storage::path($this->path);
    }
}
