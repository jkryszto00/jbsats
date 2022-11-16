<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Domain\Apply\Actions\ApplyForJobAction;
use App\Domain\Apply\Data\ApplyData;
use App\Domain\Apply\Data\CandidateData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer, Request $request)
    {
        $jobOfferData = JobOfferData::from($jobOffer);
        $candidateData = CandidateData::validateAndCreate($request->all());

        $apply = ApplyData::from([
            'job_offer' => $jobOfferData,
            'candidate' => $candidateData,
        ]);

        ApplyForJobAction::execute($apply);

        return redirect()->route('site.jobs.show', $jobOffer);
    }
}
