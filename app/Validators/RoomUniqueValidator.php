<?php

namespace Validators;

use Src\Validator\AbstractValidator;
use Model\Room;

class RoomUniqueValidator extends AbstractValidator
{
    protected string $message = 'Помещение с названием ":value" уже существует!';

    public function rule(): bool
    {
        // Нормализация данных
        $title = mb_strtolower(trim($this->value)); // Приводим к нижнему регистру и обрезаем пробелы
        $title = preg_replace('/\s+/', ' ', $title); // Удаляем двойные пробелы

        // Проверяем существование записи
        return !Room::whereRaw('LOWER(title) = ?', [$title])->exists();
    }
}