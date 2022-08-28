<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\rules\RulesAndFeedBacks;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function rules(): array
    {
        $rulesAndFeedbacks = new RulesAndFeedBacks;
        return $rulesAndFeedbacks->registerRules();
    }

    public function feedback(): array
    {
        $rulesAndFeedbacks = new RulesAndFeedBacks();
        return $rulesAndFeedbacks->registerFeedback();
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
        'verify_email'
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
