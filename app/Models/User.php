<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function rules(): array
    {
        $regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/";
        return [
            "name" => "required|min:3|max:150",
            "email" => "required|min:10",
            "password" => "required|confirmed|min:8|max:15|regex:$regex",
            "password_confirmation" => "required|min:8|max:15|regex:$regex"
        ];
    }

    public function feedback(): array
    {
        return [
            'name.min' => 'Campo nome inválido',
            'required' => 'O campo não pode ser vazio!',
            'email.min' => 'O e-mail não é valido!',
            'email.unique' => 'E-mail já esta em uso!',
            'password.confirmed' => 'Senhas inválidas por gentileza verifique!',
            'password.regex' => 'Senha deve conter números, letras e simbolos!'
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
