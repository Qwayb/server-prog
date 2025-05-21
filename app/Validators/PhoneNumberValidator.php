<?php
// File: app/Validators/PhoneNumberValidator.php

namespace Validators;

use AbstractValidator\AbstractValidator;

class PhoneNumberValidator extends AbstractValidator
{
    protected string $message = 'Номер телефона должен начинаться с 7 или 8 и содержать 11 цифр';

    public function rule(): bool
    {
        $phone = (string)$this->value;

        // Удаляем все нецифровые символы
        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        // Проверяем что номер начинается с 7 или 8 и содержит 11 цифр
        return preg_match('/^[78]\d{10}$/', $cleaned);
    }
}