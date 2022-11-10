<?php

namespace App\Domain\JobOffer\Data;

use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    ){}
}
