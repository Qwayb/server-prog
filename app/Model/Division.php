<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'birth_date',
        'user_id',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'division_id');
    }
}