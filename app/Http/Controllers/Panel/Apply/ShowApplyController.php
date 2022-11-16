<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;

class ShowApplyController extends Controller
{
    public function __invoke(JobOffer $jobOffer)
    {
        $applies = $jobOffer->applies()->rejected()->get();

        return inertia('Panel/Apply/Show', [
            'jobOffer' => $jobOffer,
            'applies' => $applies
        ]);
    }
}
