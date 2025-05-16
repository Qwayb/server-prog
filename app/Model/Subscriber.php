<?php

namespace Model;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
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
        'division_id'
    ];

    /**
     * Получить всех абонентов
     */
    public static function all($columns = ['*'])
    {
        return parent::all($columns);
    }

    /**
     * Создать нового абонента
     */
    public static function create(array $attributes = [])
    {
        return parent::create($attributes);
    }
}