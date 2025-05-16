<?php

namespace Model;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
<<<<<<< HEAD
=======
    use HasFactory;

>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
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

<<<<<<< HEAD
    // Выборка пользователя по первичному ключу
=======
    //Выборка пользователя по первичному ключу
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

<<<<<<< HEAD
    // Возврат первичного ключа
=======
    //Возврат первичного ключа
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
    public function getId(): int
    {
        return $this->id;
    }

<<<<<<< HEAD
    // Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password'])
        ])->first();
=======
    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' => md5($credentials['password'])])->first();
>>>>>>> abc4302c8843b920c617753fae1b45058f0d1e7a
    }
}