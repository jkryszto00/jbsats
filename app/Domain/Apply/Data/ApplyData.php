<?php

namespace App\Domain\Apply\Data;

use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\Apply\Models\Apply;
use App\Domain\JobOffer\Data\JobOfferData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ApplyData extends Data
{
    public function __construct(
        public readonly int|Optional $id,
        public readonly JobOfferData|Optional $job_offer,
        public readonly CandidateData|Optional $candidate,
        public readonly ApplyStatus|Optional $status
    ){}

    public static function fromModel(Apply $apply): self
    {
        return self::from([
            ...$apply->toArray(),
            'candidate' => CandidateData::fromModel($apply->candidate)
        ]);
    }
}
