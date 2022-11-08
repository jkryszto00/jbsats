<?php

namespace App\Domain\User\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserData extends Data
{
    public function __construct(
        public readonly int|Optional $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string|Optional $password,
        public readonly bool|Optional $is_employer
    ){}
}
