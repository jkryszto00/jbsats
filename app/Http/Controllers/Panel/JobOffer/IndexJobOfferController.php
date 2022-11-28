<?php

namespace App\Http\Controllers\Panel\JobOffer;

use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\JobOffer\ViewModels\PanelCollectionJobOfferViewModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexJobOfferController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('viewAny', JobOffer::class);

        return inertia('Panel/JobOffer/Index', [
            'model' => new PanelCollectionJobOfferViewModel($request)
        ]);
    }
}
