<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'division_type'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}