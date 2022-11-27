<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Domain\Apply\Actions\ApplyForJobAction;
use App\Domain\Apply\Data\ApplyData;
use App\Domain\Apply\Data\CandidateData;
use App\Domain\Apply\Requests\StoreApplyRequest;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\Services\UploadService;
use App\Http\Controllers\Controller;

class ApplyJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer, StoreApplyRequest $request, UploadService $uploadService)
    {
        $jobOfferData = JobOfferData::from($jobOffer);
        $candidateData = CandidateData::from([...$request->validated(), 'cv' => $uploadService->cv($request->file('cv'))]);

        $applyData = ApplyData::from([
            'job_offer' => $jobOfferData,
            'candidate' => $candidateData,
        ]);

        ApplyForJobAction::execute($applyData);

        return redirect()->route('site.jobs.show', $jobOffer);
    }
}
