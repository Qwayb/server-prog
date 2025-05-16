<?php

namespace Model;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a

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