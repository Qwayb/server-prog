<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'number',
        'room_id',
        'subscriber_id'
    ];

    // Связь: телефон принадлежит комнате
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Связь: телефон принадлежит абоненту
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }
}