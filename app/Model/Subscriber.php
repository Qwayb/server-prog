<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'birth_date',
        'division_id'
    ];


    // Получить всех абонентов
    public static function all($columns = ['*'])
    {
        return parent::all($columns);
    }

    // Создать нового абонента
    public static function create(array $attributes = [])
    {
        return parent::create($attributes);
    }

    // Связь: абонент имеет много телефонов
    public function phones()
    {
        return $this->hasMany(Phone::class, 'subscriber_id');
    }

    // Связь: абонент привязан к пользователю
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}