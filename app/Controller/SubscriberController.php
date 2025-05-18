<?php

namespace Controller;

use Model\Division;
use Src\Request;
use Model\Subscriber;
use Model\User;
use Src\Validator\Validator;
use Src\View;

class SubscriberController
{
    public function list(Request $request): string
    {
        try {
            // Получаем параметр безопасно
            $divisionId = $request->get('division_id');

            // Основной запрос с жадной загрузкой
            $query = Subscriber::with([
                'user',
                'phones.room.division'
            ]);

            // Применяем фильтр если есть division_id
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
            // Логирование ошибки
            error_log($e->getMessage());
            return "Произошла ошибка при загрузке данных";
        }
    }

    public function add(Request $request): string
    {
        $users = User::all(); // Для выпадающего списка пользователей

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'patronymic' => ['required'],
                'birth_date' => ['required', 'date'],
                'user_id' => ['required', 'exists:users,id']
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.subscribers-add', [
                    'users' => $users,
                    'errors' => $validator->errors()
                ]);
            }

            Subscriber::create($request->all());
            app()->route->redirect('/subscribers');
        }

        return (new View())->render('site.subscribers-add', [
            'users' => $users
        ]);
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