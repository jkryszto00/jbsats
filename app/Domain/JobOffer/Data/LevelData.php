<?php

namespace App\Domain\JobOffer\Data;

use App\Domain\JobOffer\Enums\JobOfferLevel;
use Spatie\LaravelData\Data;

class LevelData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly JobOfferLevel $value
    ){}
}
