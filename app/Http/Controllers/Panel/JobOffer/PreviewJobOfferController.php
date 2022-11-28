<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\ViewModels\ShowJobOfferViewModel;
use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class PreviewJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer): InertiaResponse
    {
        $this->authorize('view', $jobOffer);

        return inertia('Panel/JobOffer/Preview', [
            'model' => new ShowJobOfferViewModel($jobOffer)
        ]);
    }
}
