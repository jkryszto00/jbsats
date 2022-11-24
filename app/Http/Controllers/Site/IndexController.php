<?php

namespace App\Http\Controllers\Site;

use App\Domain\JobOffer\ViewModels\SiteCollectionJobOfferViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return inertia('Site/Index', [
            'model' => new SiteCollectionJobOfferViewModel($request)
        ]);
    }
}
