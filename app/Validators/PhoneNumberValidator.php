<?php
// File: app/Validators/PhoneNumberValidator.php

namespace Validators;

use AbstractValidator\AbstractValidator;

class PhoneNumberValidator extends AbstractValidator
{
    protected string $message = 'Некорректный телефон! Формат: 11 цифр, начинается с 7 или 8';

    public function rule(): bool
    {
        $phone = (string)$this->value; return (bool)preg_match(
            '/^(\+7[\s\-]?\(?\d{3}\)?[\s\-]?\d{3}[\s\-]?\d{2}[\s\-]?\d{2}|' . // +7
            '[78][\s\-]?\(?\d{3}\)?[\s\-]?\d{3}[\s\-]?\d{2}[\s\-]?\d{2}|' .   // !+
            '\d{3}[\s\-]?\d{2}[\s\-]?\d{2}|' .                                // домашние 7
            '\d{2}[\s\-]?\d{2}[\s\-]?\d{2})$/u',                              // домашние 6
            $phone
        );
    }
}