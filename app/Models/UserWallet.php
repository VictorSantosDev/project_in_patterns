<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_wallet';
    
    /** @var array */
    protected $fillable = [
        'year',
        'month',
        'name',
        'cpf'
    ];
}
