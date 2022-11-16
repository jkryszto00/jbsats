<?php

namespace App\Domain\Apply\Actions;

use App\Domain\Apply\Data\ApplyData;
use App\Domain\Apply\Models\Apply;

final class ApplyForJobAction
{
    static function execute(ApplyData $applyData): Apply
    {
         return Apply::create([
            'job_offer_id' => $applyData->job_offer->id,
            'candidate' => $applyData->candidate
        ]);
    }
}
