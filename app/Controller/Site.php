<?php

namespace Controller;

use Model\Division;
use Model\Phone;
use Model\Post;
use Model\Room;
use Model\User;
use Model\Subscriber;
use Src\Request;
use Src\Validator\Validator;
use Src\View;
use Src\Auth\Auth;

class Site
{
    public function index(): string
    {
        $posts = Post::all();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required', 'unique:users,login'],
                'password' => ['required', 'password'],
                'role' => ['required', 'in:admin,sysadmin']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Пользователь с таким логином уже существует',
                'password' => 'Пароль должен содержать 6+ символов, буквы и цифры',
                'in' => 'Некорректная роль'
            ]);

            if($validator->fails()){
                return new View('site.signup', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE),
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ]);
            }

            $userData = $request->all();
            $userData['password'] = md5($userData['password']);

            if (User::create($request->all())) {
                app()->route->redirect('/');
                return '';
            }
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }

    public function subscribers(Request $request): string
    {
        $subscribers = Subscriber::all();

        return (new View())->render('site.subscribers', [
            'subscribers' => $subscribers
        ]);
    }

    public function divisions(Request $request): string
    {
        $divisions = Division::all();

        foreach ($divisions as $division) {
            $division->subscribers_count = $division->subscribersCount();
        }

        return (new View())->render('site.divisions', [
            'divisions' => $divisions
        ]);
    }

    public function divisionPhones(Request $request, $divisionId): string
    {
        $division = Division::find($divisionId);

        if (!$division) {
            return 'Подразделение не найдено';
        }

        $phones = $division->phones;

        return (new View())->render('site.division_phones', [
            'division' => $division,
            'phones' => $phones
        ]);
    }

    public function rooms(): string
    {
        $rooms = Room::all(); // Получаем все помещения
        return (new View())->render('site.rooms', ['rooms' => $rooms]);
    }

    public function phones(): string
    {
        $phones = Phone::with(['room', 'subscriber'])->get();
        return (new View())->render('site.phones', [
            'phones' => $phones
        ]);
    }
}
