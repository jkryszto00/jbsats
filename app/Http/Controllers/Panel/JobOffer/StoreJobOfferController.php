<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\CreateJobOfferAction;
use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\ContractData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Data\LevelData;
use App\Domain\JobOffer\Data\SalaryData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Requests\CreateJobOfferRequest;
use App\Http\Controllers\Controller;

class StoreJobOfferController extends Controller
{
    public function __invoke(CreateJobOfferRequest $request, CreateJobOfferAction $createJobOfferAction)
    {
        $this->authorize('create', JobOffer::class);

        $company = auth()->user()->company;
        $jobOffer = JobOfferData::fromRequest($request);

        CreateJobOfferAction::execute($company, $jobOffer);

        return redirect()->route('panel.posting.index');
    }
}
