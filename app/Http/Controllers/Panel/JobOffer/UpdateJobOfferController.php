<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\UpdateJobOfferAction;
use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\ContractData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Data\LevelData;
use App\Domain\JobOffer\Data\SalaryData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Requests\UpdateJobOfferRequest;
use App\Http\Controllers\Controller;

class UpdateJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer, UpdateJobOfferRequest $request)
    {
        $this->authorize('update', $jobOffer);

        $jobOfferData = JobOfferData::fromRequest($request);
        UpdateJobOfferAction::execute($jobOffer, $jobOfferData);

        return redirect()->route('panel.posting.index');
    }
}
