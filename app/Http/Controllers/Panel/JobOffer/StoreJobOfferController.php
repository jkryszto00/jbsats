<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\CreateJobOfferAction;
use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\ContractData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Data\LevelData;
use App\Domain\JobOffer\Data\SalaryData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Requests\CreateJobOfferRequest;

class StoreJobOfferController
{
    public function __invoke(CreateJobOfferRequest $request, CreateJobOfferAction $createJobOfferAction)
    {
        $validated = $request->validated();
        $company = auth()->user()->company;

        $jobOffer = JobOfferData::from([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'categories' => CategoryData::collection(array_map(fn ($category) => CategoryData::from($category), $validated['category'])),
            'level' => LevelData::from([
                'name' => JobOfferLevel::tryFrom($validated['level'])->text(),
                'value' => JobOfferLevel::tryFrom($validated['level'])->value
            ]),
            'contract' => ContractData::from($validated['contract']),
            'salaries' => SalaryData::collection(array_map(fn ($salary) => SalaryData::from($salary), $validated['salary']))
        ]);

        CreateJobOfferAction::execute($company, $jobOffer);

        return redirect()->route('panel.posting.index');
    }
}
