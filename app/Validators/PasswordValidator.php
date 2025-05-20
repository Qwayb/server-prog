<?php
// File: app/Validators/PasswordValidator.php

namespace Validators;

use AbstractValidator\AbstractValidator;

class PasswordValidator extends AbstractValidator
{
    protected string $message = 'Пароль должен содержать минимум 6 символов, включая цифры и буквы';

    public function rule(): bool
    {
        $password = (string)$this->value;

        // Проверка длины
        if (strlen($password) < 6) {
            return false;
        }

        // Проверка наличия букв
        if (!preg_match('/[A-Za-zА-Яа-я]/u', $password)) {
            return false;
        }

        // Проверка наличия цифр
        return (bool)preg_match('/\d/', $password);
    }
}

