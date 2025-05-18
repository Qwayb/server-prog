<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'room_type', 'division_id'];

    // Связь с подразделением
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    // Связь с телефонами
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}