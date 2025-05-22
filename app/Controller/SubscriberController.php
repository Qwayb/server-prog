<?php

namespace Controller;

use Model\Division;
use Src\Request;
use Model\Subscriber;
use Model\User;
use Src\Validator\Validator;
use Src\View;
use Validators\CyrillicValidator;
use Qwayb\ExceptionHandler\ExceptionHandler;
use Exception;

class SubscriberController
{
    public function list(Request $request): string
    {
        try {
            // Получаем параметр безопасно
            $divisionId = $request->get('division_id');

            $query = Subscriber::with([
                'user',
                'phones.room.division'
            ]);

            if ($divisionId && is_numeric($divisionId)) {
                $query->whereHas('phones.room.division', function($q) use ($divisionId) {
                    $q->where('id', $divisionId);
                });
            }

            $subscribers = $query->get();
            $divisions = Division::all();

            return (new View())->render('site.subscribers', [
                'subscribers' => $subscribers,
                'divisions' => $divisions,
                'selectedDivision' => $divisionId
            ]);

        } catch (Exception $e) {
            error_log($e->getMessage());
            return "Произошла ошибка при загрузке данных";
        }
    }

    public function add(Request $request): string
    {
        $users = User::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'surname' => ['required', 'cyrillic', 'min:2', 'max:50'],
                'name' => ['required', 'cyrillic', 'min:2', 'max:50'],
                'patronymic' => ['required', 'cyrillic', 'min:2', 'max:50'],
                'birth_date' => ['required', 'date', 'adult'],
                'user_id' => ['required', 'exists:users,id']
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'cyrillic' => 'Поле :field должно содержать только кириллические символы',
                'min' => 'Поле :field должно содержать минимум :min символа',
                'max' => 'Поле :field должно содержать максимум :max символов',
                'date' => 'Некорректная дата',
                'adult' => 'Возраст должен быть 18 лет или больше',
                'exists' => 'Выбранный пользователь не существует'
            ]);

            if ($validator->fails()) {
                return new View('site.subscribers-add', [
                    'users' => $users,
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE),
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ]);
            }

            Subscriber::create($request->all());
            app()->route->redirect('/subscribers');
        }

        return new View('site.subscribers-add', ['users' => $users]);
    }
    public function viewPhones(Request $request, string $id): string
    {
        $subscriber = Subscriber::with(['phones.room.division'])->find($id);

        if (!$subscriber) {
            app()->route->redirect('/subscribers');
        }

        return (new View())->render('site.subscriber-phones', [
            'subscriber' => $subscriber
        ]);
    }
}