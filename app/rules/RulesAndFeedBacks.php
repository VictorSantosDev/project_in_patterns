<?php

namespace App\rules;

class RulesAndFeedBacks
{
    private $regexPassword = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/";

    public function authUserRules(): array
    {
        return [
            "email" => "required",
            "password" => "required|min:8|max:15|regex:$this->regexPassword",
        ];
    }

    public function authUserFeedback(): array
    {
        return [
            'required' => 'O campo não pode ser vazio!',
            'password.regex' => 'Senha deve conter números, letras e simbolos!',
            'password.min' => 'Senha tem que ter no minimo 8 caracteres!',
            'password.max' => 'Senha tem que ter no maximo 15 caracteres!',
        ];
    }
    
    public function registerRules(): array
    {
        return [
            "name" => "required|min:3|max:150",
            "email" => "required|min:10|unique:users,email",
            "password" => "required|confirmed|min:8|max:15|regex:$this->regexPassword",
            "password_confirmation" => "required|min:8|max:15|regex:$this->regexPassword"
        ];
    }

    public function registerFeedback(): array
    {
        return [
            'name.min' => 'Campo nome inválido',
            'required' => 'O campo não pode ser vazio!',
            'email.min' => 'O e-mail não é valido!',
            'email.unique' => 'E-mail já esta em uso!',
            'password.confirmed' => 'Senhas inválidas por gentileza verifique!',
            'password.regex' => 'Senha deve conter números, letras e simbolos!',
            'password.min' => 'Senha tem que ter no minimo 8 caracteres!'
        ];
    }
}
