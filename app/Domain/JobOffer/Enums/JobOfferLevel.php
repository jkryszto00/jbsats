<?php

namespace App\Domain\JobOffer\Enums;

enum JobOfferLevel: int
{
    case ENTRY = 1;
    case JUNIOR = 2;
    case MID = 3;
    case SENIOR = 4;
    case EXPERT = 5;

    public function text():string
    {
        return match($this) {
            self::ENTRY => 'entry',
            self::JUNIOR => 'junior',
            self::MID => 'mid',
            self::SENIOR => 'senior',
            self::EXPERT => 'expert'
        };
    }
}
