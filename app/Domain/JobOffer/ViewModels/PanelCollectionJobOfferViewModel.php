<?php

namespace App\Domain\JobOffer\ViewModels;

use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Enums\JobOfferStatus;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\ViewModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

class PanelCollectionJobOfferViewModel extends ViewModel
{
    public function __construct(
        public Request $request
    ){}

    public function filters(): array
    {
        return [
            'title' => $this->request->get('title'),
            'status' => match (JobOfferStatus::tryFrom($this->request->get('status'))) {
                JobOfferStatus::PUBLISHED => JobOfferStatus::PUBLISHED,
                JobOfferStatus::DRAFTS => JobOfferStatus::DRAFTS,
                default => 'all'
            }
        ];
    }

    public function statuses(): array
    {
        return JobOfferStatus::cases();
    }

    public function jobOffers(): DataCollection
    {
        return JobOfferData::collection(JobOffer::with('company', 'categories', 'contract', 'salaries')->filter($this->filters())->get()->map(fn ($jobOffer) => JobOfferData::from($jobOffer)));
    }
}
