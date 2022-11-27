<?php

namespace App\Domain\Shared\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class FileData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $file_name,
        public readonly string $mime_type,
        public readonly string|Optional $path,
        public readonly string $disk,
        public readonly string $collection,
        public readonly int $size
    ){}
}
