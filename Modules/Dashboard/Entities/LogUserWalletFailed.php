<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogUserWalletFailed extends Model
{
    use HasFactory;

    protected $table = 'table_log_import_user_wallet_failed';
    
    protected $fillable = ['title', 'description'];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\LogUserWalletFailedFactory::new();
    }
}
