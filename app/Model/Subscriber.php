<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

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