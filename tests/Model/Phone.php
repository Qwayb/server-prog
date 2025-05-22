<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table    = 'phones';
    public    $timestamps = false;
    protected $fillable = ['number', 'room_id', 'subscriber_id'];

    /** Скоуп, который использует тест */
    public static function bySubscriber(int $subscriberId)
    {
        return static::where('subscriber_id', $subscriberId)->get();
    }
}