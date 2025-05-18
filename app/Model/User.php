<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    public $timestamps = false;
    protected $fillable = [
        'login',
        'password',
        'role'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    // Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    // Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    // Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password'])
        ])->first();
    }

    // Связь: пользователь имеет много абонентов
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'user_id');
    }
}