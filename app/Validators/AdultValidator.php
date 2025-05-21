<?php
// File: app/Validators/AdultValidator.php

namespace Validators;

use AbstractValidator\AbstractValidator;

class AdultValidator extends AbstractValidator
{
    protected string $message = 'Возраст должен быть 18 лет или больше';

    public function rule(): bool
    {
        $birthDate = $this->value;

        if (empty($birthDate)) {
            return false;
        }

        $birthDate = new \DateTime($birthDate);
        $today = new \DateTime();
        $diff = $today->diff($birthDate);

        return $diff->y >= 18;
    }
}