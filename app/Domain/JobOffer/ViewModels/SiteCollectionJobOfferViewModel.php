<?php

namespace App\Domain\JobOffer\ViewModels;

use App\Domain\JobOffer\Data\CategoryData;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Enums\Contract\ContractType;
use App\Domain\JobOffer\Enums\JobOfferLevel;
use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\ViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataCollection;

class SiteCollectionJobOfferViewModel extends ViewModel
{
    public function __construct(
        public Request $request
    ){}

    public function filters(): array
    {
        return [
            'title' => $this->request->get('title'),
            'category' => $this->request->get('category') ? explode(',', $this->request->get('category')): null,
            'level' => $this->request->get('level') ? explode(',', $this->request->get('level')) : null,
            'type' => $this->request->get('contract') ? explode(',', $this->request->get('contract')) : null
        ];
    }

    public function categories(): Collection
    {
        return Category::all()->map(fn (Category $category) => CategoryData::from($category));
    }

    public function levels(): Collection
    {
        return collect(JobOfferLevel::cases())->map(fn (JobOfferLevel $level) => [
            'name' => $level->text(),
            'value' => $level->value
        ]);
    }

    public function types(): Collection
    {
        return collect(ContractType::cases())->map(fn (ContractType $type) => $type);
    }

    public function jobOffers(): DataCollection
    {
        return JobOfferData::collection(JobOffer::with('company', 'categories', 'contract', 'salaries')->filter($this->filters())->get()->map(fn ($jobOffer) => JobOfferData::from($jobOffer)));
    }
}
