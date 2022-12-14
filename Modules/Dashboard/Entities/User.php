<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;
 
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\UserFactory::new();
    }
}
