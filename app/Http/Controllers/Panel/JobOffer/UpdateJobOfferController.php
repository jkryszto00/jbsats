<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Actions\UpdateJobOfferAction;
use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\Contract\ContractData;
use App\Domain\JobOffer\Data\Contract\SalaryData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateJobOfferRequest;

class UpdateJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer, UpdateJobOfferRequest $request, UpdateJobOfferAction $updateJobOfferAction)
    {
        $validated = $request->validated();

        $categories = Category::whereIn('id', $validated['category'])->get();
        $salaries = [];

        foreach ($validated['salary'] as $salary) {
            $salaries[] = SalaryData::from(array_filter($salary, null));
        }

        $jobOfferData = JobOfferData::from([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => CategoryData::collection($categories),
            'level' => JobOfferLevel::from($validated['level']),
            'contract' => ContractData::from($validated['contract']),
            'salary' => SalaryData::collection($salaries)
        ]);

        $updateJobOfferAction($jobOffer, $jobOfferData);

        return redirect()->route('panel.posting.index');
    }
}
