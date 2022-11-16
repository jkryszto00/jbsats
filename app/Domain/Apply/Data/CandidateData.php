<?php

namespace App\Domain\Apply\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class CandidateData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $about,
//        public readonly UploadedFile $cv
    ){}

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'about' => ['required', 'string']
        ];
    }
}
