<?php

namespace App\Http\Controllers\Site\JobOffer;

use App\Domain\JobOffer\ViewModels\SiteCollectionJobOfferViewModel;
use Illuminate\Http\Request;

class IndexJobOfferController
{
    public function __invoke(Request $request)
    {
        return inertia('Site/JobOffer/Index', [
            'model' => new SiteCollectionJobOfferViewModel($request)
        ]);
    }
}
