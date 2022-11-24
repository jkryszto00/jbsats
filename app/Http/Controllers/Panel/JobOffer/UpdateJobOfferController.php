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
        $validated = $request->validated();

        $jobOfferData = JobOfferData::from([
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

        UpdateJobOfferAction::execute($jobOffer, $jobOfferData);

        return redirect()->route('panel.posting.index');
    }
}
