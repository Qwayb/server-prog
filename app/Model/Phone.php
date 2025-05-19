<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    protected $fillable = ['number', 'room_id', 'subscriber_id'];

    // Отключаем автоматическое управление временными метками
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}