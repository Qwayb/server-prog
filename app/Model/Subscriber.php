<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public $timestamps = false;
    protected $fillable = ['surname', 'name', 'patronymic', 'birth_date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'subscriber_id');
    }

}