<?php
namespace Src\Validator;

class RussianPhoneValidator implements ValidatorInterface
{
    public function validate($value): bool
    {
        // Удаляем все нецифровые символы, кроме +
        $cleaned = preg_replace('/[^\d+]/', '', $value);

        // Проверяем основные форматы российских номеров:
        // +7XXXXXXXXXX (11 цифр)
        // 8XXXXXXXXXX (11 цифр)
        // +7(XXX)XXX-XX-XX (разные форматы записи)
        return preg_match('/^(\+7|8)\d{10}$/', $cleaned);
    }

    public function message(): string
    {
        return 'Номер телефона должен быть в российском формате: +7XXX... или 8XXX... (10 цифр после кода)';
    }
}
