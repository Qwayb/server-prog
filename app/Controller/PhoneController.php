<?php
namespace Controller;

use Src\Request;
use Model\Phone;
use Model\Room;
use Model\Subscriber;
use Src\Validator\Validator;
use Src\View;
use Qwayb\ExceptionHandler\ExceptionHandler;
use Qwayb\ExceptionHandler\ExceptionRegistry;

class PhoneController
{
    // Метод для отображения списка всех номеров
    public function list(): string
    {
        $phones = Phone::with(['room', 'subscriber'])->get();
        $subscribers = Subscriber::all(); // Для формы прикрепления

        return (new View())->render('site.phones', [
            'phones' => $phones,
            'allSubscribers' => $subscribers // Передаем всех абонентов
        ]);
    }

    // Метод для добавления нового номера
    public function add(Request $request): string
    {
        $rooms = Room::all();
        $subscribers = Subscriber::all();

        if ($request->method === 'POST') {
            $validator = new Validator(
                $request->all(),
                [
                    'number' => ['required', 'phone'],
                    'room_id' => ['required', 'exists:rooms,id'],
                    'subscriber_id' => ['nullable', 'exists:subscribers,id']
                ],
                [
                    'required' => 'Поле :field обязательно для заполнения',
                    'phone' => 'Некорректный телефон! Формат: 11 цифр, начинается с 7 или 8',
                    'exists' => 'Выбранное значение не существует'
                ]
            );

            if ($validator->fails()) {
                error_log("Validation errors: " . print_r($validator->errors(), true));
                return (new View())->render('site.phones-add', [
                    'rooms' => $rooms,
                    'subscribers' => $subscribers,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ]);
            }

            Phone::create($request->all());
            app()->route->redirect('/phones');
        }

        return (new View())->render('site.phones-add', [
            'rooms' => $rooms,
            'subscribers' => $subscribers
        ]);
    }

    public function attachSubscriber(string $id, Request $request): void
    {
        try {
            // Получаем телефон по ID
            $phone = Phone::find($id);
            if (!$phone) {
                throw new \Exception("Телефон с ID $id не найден");
            }

            // Получаем ID абонента из запроса
            $subscriberId = $request->get('subscriber_id');
            if (!$subscriberId) {
                throw new \Exception("Не указан ID абонента");
            }

            // Проверяем существование абонента
            if (!Subscriber::find($subscriberId)) {
                throw new \Exception("Абонент с ID $subscriberId не найден");
            }

            // Обновляем привязку
            $phone->subscriber_id = $subscriberId;
            $phone->save();

        } catch (\Exception $e) {
            error_log("Ошибка прикрепления абонента: " . $e->getMessage());
        }

        // Перенаправляем обратно
        app()->route->redirect('/phones');
    }
    public function detachSubscriber($id)
    {
        $phone = Phone::find($id);

        if ($phone) {
            $phone->subscriber_id = null;
            $phone->save();
        }

        app()->route->redirect('/phones');
    }

}
