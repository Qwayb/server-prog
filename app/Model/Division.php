<?php

namespace Model;

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

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