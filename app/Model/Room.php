<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'room_type',
        'division_id'
    ];

    // Обратная связь с телефонами
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    // Связь "один ко многим" с Phone
    public function phones()
    {
        return $this->hasMany(Phone::class, 'room_id');
    }
}