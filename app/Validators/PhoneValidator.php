<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PhoneValidator extends AbstractValidator
{
    protected string $message = 'Телефон должен содержать 11 цифр и начинаться с 7 или 8';

    public function rule(): bool
    {
        $value = (string)$this->value;

        // Полная очистка от всех символов кроме цифр
        $digits = preg_replace('/\D/', '', $value);

        // Логирование для отладки
        error_log("Phone validation: Original: '$value' | Cleaned: '$digits'");

        // Проверка длины
        if (strlen($digits) !== 11) {
            error_log("Validation failed: wrong length");
            return false;
        }

        // Проверка префикса
        $valid = in_array($digits[0], ['7', '8']);
        if (!$valid) {
            error_log("Validation failed: wrong prefix");
        }

        return $valid;
    }
}