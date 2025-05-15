<?php

namespace App\Domain\Directions\Model;

use App\Domain\Service\Model\Service;
use Illuminate\Database\Eloquent\Model;

class Directions extends Model
{
    protected $fillable = [
        'name' ,
        'is_active',
    ];

    public function service()
    {
        return $this->hasMany(Service::class , 'direction_id');
    }
}
