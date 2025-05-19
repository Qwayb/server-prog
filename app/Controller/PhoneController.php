<?php
namespace Controller;

use Src\Request;
use Model\Phone;
use Model\Room;
use Model\Subscriber;
use Src\View;

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
        if ($request->method === 'POST') {
            $phone = new Phone();
            $phone->number = $request->get('number');
            $phone->room_id = $request->get('room_id');
            $phone->subscriber_id = $request->get('subscriber_id') ?: null;

            if ($phone->save()) {
                header('Location: /phones');
                exit;
            }
        }

        return (new View())->render('site.phones-add', [
            'rooms' => Room::all(),
            'subscribers' => Subscriber::all()
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
