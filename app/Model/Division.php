<?php

namespace Model;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'birth_date',
        'user_id',
    ];

    public static function all($columns = ['*'])
    {
        return parent::all($columns);
    }
}