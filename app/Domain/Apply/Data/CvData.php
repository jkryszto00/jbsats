<?php

namespace App\Domain\Apply\Data;

use Spatie\LaravelData\Data;

class CvData extends Data
{
    public function __construct(
        public readonly string $file_name,
        public readonly int $size,
        public readonly string $path
    ){}
}
