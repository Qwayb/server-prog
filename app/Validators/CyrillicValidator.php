<?php
// File: app/Validators/CyrillicNameValidator.php

namespace Validators;

use AbstractValidator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{
    protected string $message = 'Поле должно содержать только кириллические символы, пробелы и дефисы';

    public function rule(): bool
    {
        $name = (string)$this->value;

        // Проверяем, что строка не пустая
        if (empty(trim($name))) {
            return false;
        }

        // Проверяем, что строка содержит только кириллические буквы, пробелы и дефисы
        return (bool)preg_match('/^[\p{Cyrillic}\s-]+$/u', $name);
    }
}