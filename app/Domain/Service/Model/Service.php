<?php

namespace App\Domain\Service\Model;

use App\Domain\Directions\Model\Directions;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'direction_id' ,
        'name',
        'price',
        'status',
    ];

    public function direction()
    {
        return $this->belongsTo(Directions::class , 'direction_id');
    }
}
