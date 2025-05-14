<?php

namespace App\Domain\Directions\Model;

use Illuminate\Database\Eloquent\Model;

class Directions extends Model
{
    protected $fillable = [
        'name' ,
        'is_active',
    ];
}
