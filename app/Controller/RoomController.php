<?php

namespace Controller;

use Src\Request;
use Model\Room;
use Model\Division;
use Src\Validator\Validator;
use Src\View;

class RoomController
{
    public function add(Request $request): string
    {
        $divisions = Division::all(); // Получаем все подразделения для выпадающего списка

        if ($request->method === 'POST') {
            // Валидация данных
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'room_type' => ['required'],
                'division_id' => ['required', 'exists:divisions,id']
            ]);

            if ($validator->fails()) {
                // Возвращаем форму с ошибками
                return (new View())->render('site.rooms-add', [
                    'divisions' => $divisions,
                    'errors' => $validator->errors()
                ]);
            }

            // Сохраняем помещение в БД
            Room::create($request->all());
            app()->route->redirect('/rooms');
        }

        // Отображаем форму для GET-запроса
        return (new View())->render('site.rooms-add', [
            'divisions' => $divisions
        ]);
    }
}