<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWallet extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'users_wallet';

    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\UserWalletFactory::new();
    }
}
