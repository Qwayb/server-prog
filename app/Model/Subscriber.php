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

    public function getDivisionsAttribute()
    {
        return $this->phones->map(function($phone) {
            return $phone->room->division ?? null;
        })->filter()->unique('id');
    }

    public function getFullName(): string
    {
        return trim($this->surname . ' ' . $this->name . ' ' . $this->patronymic);
    }
}