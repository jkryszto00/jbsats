<?php

namespace App\Domain\Apply\Actions;

use App\Domain\Apply\Data\ApplyData;
use App\Domain\Apply\Data\CandidateData;
use App\Domain\Apply\Models\Apply;
use App\Domain\Apply\Models\Candidate;
use Illuminate\Support\Facades\DB;

final class ApplyForJobAction
{
    static function execute(ApplyData $applyData): Apply
    {
        return DB::transaction(function () use ($applyData) {
            $candidate = Candidate::create($applyData->candidate->toArray());
            $candidate->media()->create($applyData->candidate->cv->toArray());

            return Apply::create([
                'job_offer_id' => $applyData->job_offer->id,
                'candidate_id' => $candidate->id
            ]);
        });
    }
}
