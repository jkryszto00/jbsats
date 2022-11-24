<?php

namespace App\Http\Controllers\Panel;

use App\Domain\Apply\Models\Apply;
use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __invoke(): InertiaResponse
    {
        $counts = [
            'published' => JobOffer::published()->count(),
            'draft' => JobOffer::drafts()->count(),
            'expired' => JobOffer::expired()->count()
        ];

        $applications = Apply::with('jobOffer')->get();

        return inertia('Panel/Dashboard', [
            'counts' => $counts,
            'applications' => $applications
        ]);
    }
}
