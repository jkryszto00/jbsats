<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;

class IndexApplyController extends Controller
{
    public function __invoke()
    {
        return inertia('Panel/Apply/Index', [
            'jobOffers' => JobOffer::withCount('applies')->get()
        ]);
    }
}
