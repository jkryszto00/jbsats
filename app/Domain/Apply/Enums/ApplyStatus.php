<?php

namespace App\Domain\Apply\Enums;

enum ApplyStatus: string
{
    case REJECTED = 'rejected';
    case APPLIED = 'applied';
    case ACCEPTED = 'accepted';
}
