<?php

namespace App\Domain\Directions\Model;

use App\Domain\Service\Model\Service;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $fillable = [
        'name' ,
        'is_active',
    ];

    public function service()
    {
        return $this->hasMany(Service::class , 'direction_id');
    }

    public function doctor()
    {
        return $this->hasMany(Doctor::class , 'direction_id');
    }
}
