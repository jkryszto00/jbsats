<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\ViewModels\PanelCollectionApplyViewModel;
use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowApplyController extends Controller
{
    public function __invoke(JobOffer $jobOffer, Request $request)
    {
        return inertia('Panel/Apply/Show', [
            'model' => new PanelCollectionApplyViewModel($jobOffer, $request)
        ]);
    }
}
