<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $timestamps = false;
    protected $fillable = ['number', 'room_id', 'subscriber_id'];

    // Связь с помещением
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Связь с абонентом
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}