<?php

namespace App\Domain\Service\Model;

use App\Domain\Directions\Model\Direction;
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
        return $this->belongsTo(Direction::class , 'direction_id');
    }
}
