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
        $selectedDivision = $request->get('division_id');

        $subscribers = Subscriber::when($selectedDivision, function ($query) use ($selectedDivision) {
            $query->whereHas('phones.room.division', function ($q) use ($selectedDivision) {
                $q->where('id', $selectedDivision);
            });
        })->get();

        $divisions = Division::all();

        return (new View())->render('site.subscribers', [
            'subscribers' => $subscribers,
            'divisions' => $divisions,
            'selectedDivision' => $selectedDivision
        ]);
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
}