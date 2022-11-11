<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Enums\Contract\ContractCurrency;
use App\Domain\JobOffer\Enums\Contract\ContractPer;
use App\Domain\JobOffer\Enums\Contract\ContractTime;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\CategoryResource;
use App\Http\Controllers\Controller;

class EditJobOfferController extends Controller
{
    public function __invoke(JobOffer $jobOffer)
    {
        $jobOffer = $jobOffer->load('categories');

        $categories = CategoryResource::collection(Category::all());
        $levels = array_map(fn (JobOfferLevel $level) => [
            'name' => $level->text(),
            'value' => $level->value
        ], JobOfferLevel::cases());

        $pers = ContractPer::cases();
        $currencies = ContractCurrency::cases();
        $types = ContractType::cases();
        $times = ContractTime::cases();

        return inertia('Panel/JobOffer/Edit', [
            'categories' => $categories,
            'levels' => $levels,
            'currencies' => $currencies,
            'types' => $types,
            'times' => $times,
            'pers' => $pers,
            'jobOffer' => $jobOffer
        ]);
    }
}
