<?php

namespace Controller;

use Model\Division;
use Src\Request;
use Src\Validator\Validator;
use Src\View;
use Model\Subscriber;

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
        $old = $request->all(); // Сохраняем введенные данные

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'division_type' => ['required']
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
            } else {
                try {
                    Division::create([
                        'title' => $request->get('title'),
                        'division_type' => $request->get('division_type')
                    ]);

                    app()->route->redirect('/divisions');
                    return '';

                } catch (\Exception $e) {
                    $errors['database'] = ['Ошибка при сохранении: ' . $e->getMessage()];
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