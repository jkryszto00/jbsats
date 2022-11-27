<?php

namespace App\Domain\Apply\ViewModels;

use App\Domain\Apply\Data\ApplyData;
use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\JobOffer\Data\JobOfferData;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\ViewModel;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

class PanelCollectionApplyViewModel extends ViewModel
{
    public function __construct(
        public readonly JobOffer $jobOffer,
        public readonly Request $request
    ){}

    public function statuses(): array
    {
        return ApplyStatus::cases();
    }

    public function filters(): array
    {
        return [
            'status' => $this->request->get('status') ? ApplyStatus::tryFrom($this->request->get('status')) : ApplyStatus::APPLIED
        ];
    }

    public function jobOffer(): JobOfferData
    {
        return JobOfferData::from($this->jobOffer);
    }

    public function applies(): DataCollection
    {
        return ApplyData::collection($this->jobOffer->applies()->filter($this->filters())->get()->load('candidate')->map(fn ($apply) => ApplyData::fromModel($apply)));
    }
}
