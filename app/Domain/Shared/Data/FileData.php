<?php

namespace App\Domain\Shared\Data;

use Spatie\LaravelData\Data;

class FileData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $file_name,
        public readonly string $mime_type,
        public readonly string $path,
        public readonly string $disk,
        public readonly string $collection,
        public readonly int $size
    ){}
}
