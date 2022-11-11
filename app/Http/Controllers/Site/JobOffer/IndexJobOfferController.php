<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Domain\JobOffer\Models\Category;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\Resources\CategoryResource;
use App\Domain\JobOffer\Resources\JobOfferResource;

class IndexJobOfferController
{
    public function __invoke()
    {
        $jobOffers = JobOfferResource::collection(JobOffer::with('company', 'categories')->get());

        return inertia('Site/JobOffer/Index', [
            'categories' => CategoryResource::collection(Category::all()),
            'jobOffers' => $jobOffers,
            'jobOffersCount' => $jobOffers->count()
        ]);
    }
}
