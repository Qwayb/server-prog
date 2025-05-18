<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'division_type'];

    // Связь с помещениями
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // Подсчёт абонентов через цепочку: Division → Rooms → Phones → Subscribers
    public function getSubscribersCountAttribute()
    {
        return Phone::whereHas('room', function($query) {
            $query->where('division_id', $this->id);
        })
            ->whereNotNull('subscriber_id')
            ->distinct('subscriber_id')
            ->count('subscriber_id');
    }

}