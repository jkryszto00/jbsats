<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\JobOfferResource;
use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class PreviewJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer): InertiaResponse
    {
        return inertia('Panel/JobOffer/Preview', [
            'jobOffer' => new JobOfferResource($jobOffer->load('company', 'categories'))
        ]);
    }
}
