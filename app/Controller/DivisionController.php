<?php

namespace Controller;

use Exception;
use Model\Division;
use Src\Request;
use Src\Validator\Validator;
use Src\View;
use Model\Subscriber;
use Qwayb\ExceptionHandler\ExceptionHandler;

class DivisionController
{
    public function list(): string
    {
        $divisions = Division::all();
        return (new View())->render('site.divisions', [
            'divisions' => $divisions
        ]);
    }

    public function add(Request $request): string
    {
        $errors = [];
        $old = $request->all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title' => ['required', 'unique:divisions,title', 'cyrillic'],
                'division_type' => ['required', 'cyrillic'],
                [
                    'unique' => 'Помещение ":value" уже существует!'
                ]
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                $handler = new ExceptionHandler(
                    function(Exception $e) {
                        return [
                            'success' => false,
                            'error' => [
                                'message' => 'Ошибка при сохранении: ' . $e->getMessage(),
                                'type' => 'database_error',
                                'status' => 500
                            ]
                        ];
                    },
                    true // debug mode
                );

                $result = $handler->handle(function() use ($request) {
                    Division::create([
                        'title' => $request->get('title'),
                        'division_type' => $request->get('division_type')
                    ]);

                    app()->route->redirect('/divisions');
                    return '';
                });

                if (!$result['success']) {
                    $errors['database'] = [$result['error']['message']];
                }
            }
        }

        return (new View())->render('site.divisions-add', [
            'errors' => $errors,
            'old' => $old
        ]);
    }

    public function selectDivision(): string
    {
        $divisions = Division::all();
        return (new View())->render('site.division-select', [
            'divisions' => $divisions
        ]);
    }

    // Список абонентов конкретного подразделения
    public function listSubscribers(string $id, Request $request): string
    {
        // Проверяем, что подразделение существует
        if (!$division = Division::find($id)) {
            throw new \Exception('Подразделение не найдено');
        }

        $subscribers = Subscriber::whereHas('phones.room', function($query) use ($id) {
            $query->where('division_id', $id);
        })->get();

        return (new View())->render('site.division-subscribers', [
            'subscribers' => $subscribers,
            'division' => $division
        ]);
    }
}