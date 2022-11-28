<?php

namespace App\Domain\Shared\ViewModels;

use App\Domain\Apply\Data\ApplyData;
use App\Domain\Apply\Models\Apply;
use App\Domain\JobOffer\Models\JobOffer;
use Spatie\LaravelData\DataCollection;

class PanelDashboardViewModel extends ViewModel
{
    public function counts(): array
    {
        return [
            'published' => JobOffer::published()->count(),
            'drafts' => JobOffer::drafts()->count(),
            'expired' => JobOffer::expired()->count(),
        ];
    }

    public function applications(): DataCollection
    {
        return ApplyData::collection(Apply::with('candidate', 'jobOffer')
            ->whereIn('job_offer_id', auth()->user()->company->jobOffers->pluck('id'))
            ->latest()
            ->get()
            ->take(5)
            ->map(fn ($apply) => ApplyData::fromModel($apply))
        );
    }
}
