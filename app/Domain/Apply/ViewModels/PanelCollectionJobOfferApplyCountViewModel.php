<?php

namespace App\Domain\Apply\ViewModels;

use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\ViewModel;
use Spatie\LaravelData\DataCollection;

class PanelCollectionJobOfferApplyCountViewModel extends ViewModel
{
    public function jobOffers(): DataCollection
    {
        return JobOfferData::collection(JobOffer::withCount('applies')->get()->map(fn ($jobOffer) => JobOfferData::from($jobOffer)));
    }
}
