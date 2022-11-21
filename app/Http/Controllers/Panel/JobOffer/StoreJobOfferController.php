<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\CreateJobOfferAction;
use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\Contract\ContractData;
use App\Domain\JobOffer\Data\Contract\SalaryData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Requests\CreateJobOfferRequest;

class StoreJobOfferController
{
    public function __invoke(CreateJobOfferRequest $request, CreateJobOfferAction $createJobOfferAction)
    {
        $validated = $request->validated();
        $categories = [];
        $salaries = [];

        foreach ($validated['category'] as $category) {
            $categories[] = CategoryData::from($category);
        }

        foreach ($validated['salary'] as $salary) {
            $salaries[] = SalaryData::from(array_filter($salary, null));
        }

        $company = auth()->user()->company;
        $jobOffer = JobOfferData::from([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => CategoryData::collection($categories),
            'level' => JobOfferLevel::from($validated['level']),
            'contract' => ContractData::from($validated['contract']),
            'salary' => SalaryData::collection($salaries)
        ]);

        CreateJobOfferAction::execute($company, $jobOffer);

        return redirect()->route('panel.posting.index');
    }
}
