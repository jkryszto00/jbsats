<?php

namespace App\Domain\Apply\Data;

use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\JobOffer\Data\JobOfferData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class ApplyData extends Data
{
    public function __construct(
        public readonly int|Optional $id,
        public readonly JobOfferData $job_offer,
        public readonly CandidateData $candidate,
        public readonly ApplyStatus|Optional $status
    ){}

    public static function rules(): array
    {
        return [
            'job_offer_id' => 'required', 'exists:job_offers,id',
            'candidate_id' => 'required', 'exists:candidates,id',
            'status' => ['sometimes','required', new Enum(ApplyStatus::class)]
        ];
    }

    public static function fromRequest(Request $request): self
    {
        return self::from([
            ...$request->all(),

        ]);
    }
}
