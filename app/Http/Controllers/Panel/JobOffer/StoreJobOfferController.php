<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\CreateJobOfferAction;
use App\Domain\JobOffer\Data\Contract\ContractData;
use App\Domain\JobOffer\Data\Contract\SalaryData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Requests\CreateJobOfferRequest;

class StoreJobOfferController
{
    public function __invoke(CreateJobOfferRequest $request, CreateJobOfferAction $createJobOfferAction)
    {
        $validated = $request->validated();
        $salaries = [];

        foreach ($validated['salary'] as $salary) {
            $salaries[] = SalaryData::from(array_filter($salary, null));
        }

        $company = auth()->user()->company;
        $jobOffer = JobOfferData::from([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'level' => JobOfferLevel::from($validated['level']),
            'contract' => ContractData::from($validated['contract']),
            'salary' => SalaryData::collection($salaries)
        ]);

        $createJobOfferAction($company, $jobOffer);

        return redirect()->route('panel.posting.index');
    }
}
