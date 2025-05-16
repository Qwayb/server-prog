<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'title',
        'room_type',
        'division_id ',
    ];

    public static function all($columns = ['*'])
    {
        return parent::all($columns);
    }
}