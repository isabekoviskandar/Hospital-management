<?php

namespace App\Domain\Doctor\Model;


use App\Domain\Directions\Model\Direction;
use App\Domain\User\User;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'direction_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'salary_type',
        'salary',
        'profile_picture',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class , 'direction_id');
    }
}
