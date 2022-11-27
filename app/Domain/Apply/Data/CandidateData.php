<?php

namespace App\Domain\Apply\Data;

use App\Domain\Apply\Models\Candidate;
use App\Domain\Shared\Data\FileData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CandidateData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $about,
        public readonly FileData|Optional $cv
    ){}

    public static function fromModel(Candidate $candidate): self
    {
        return self::from([
            ...$candidate->toArray(),
            'cv' => $candidate->cv
        ]);
    }
}

