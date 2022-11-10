<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Enums\JobOfferStatus;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\JobOfferResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexJobOfferController extends Controller
{
    public function __invoke(Request $request)
    {
        $filters = [
            'title' => $request->get('title'),
            'status' => match ($request->get('status')) {
                JobOfferStatus::PUBLISHED->text() => JobOfferStatus::PUBLISHED->text(),
                JobOfferStatus::DRAFTS->text() => JobOfferStatus::DRAFTS->text(),
                default => 'all'
            }
        ];

        $jobOffers = JobOfferResource::collection(JobOffer::filter($filters)->with('categories')->get());

        $statuses = array_map(fn (JobOfferStatus $status) => $status->text(), JobOfferStatus::cases());

        return inertia('Panel/JobOffer/Index', [
            'filters' => $filters,
            'statuses' => $statuses,
            'jobOffers' => $jobOffers
        ]);
    }
}
