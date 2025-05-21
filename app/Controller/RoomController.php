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
        $divisions = Division::all();

        if ($request->method === 'POST') {
            // Нормализация данных перед валидацией
            $data = $request->all();
            $data['title'] = mb_strtolower(trim($data['title']));
            $data['title'] = preg_replace('/\s+/', ' ', $data['title']);

            $validator = new Validator(
                $data,
                [
                    'title' => ['required', 'room_unique', 'cyrillic'],
                    'room_type' => ['required', 'cyrillic'],
                    'division_id' => ['required', 'exists:divisions,id']
                ],
                [
                    'room_unique' => 'Помещение ":value" уже существует!'
                ]
            );

            if ($validator->fails()) {
                return (new View())->render('site.rooms-add', [
                    'divisions' => $divisions,
                    'errors' => $validator->errors(),
                    'old' => $data
                ]);
            }

            Room::create($data);
            app()->route->redirect('/rooms');
        }

        return (new View())->render('site.rooms-add', [
            'divisions' => $divisions
        ]);
    }
}