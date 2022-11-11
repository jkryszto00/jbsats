<?php

namespace App\Http\Controllers\Site;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\JobOfferResource;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $jobOffers = JobOfferResource::collection(JobOffer::with('company', 'categories')->get());

        return inertia('Site/Index', [
            'jobOffers' => $jobOffers
        ]);
    }
}
