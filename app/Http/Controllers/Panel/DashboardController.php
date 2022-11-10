<?php

namespace App\Http\Controllers\Panel;

use App\Domain\JobOffer\Models\JobOffer;
use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __invoke(): InertiaResponse
    {
        $counts = [
            'published' => JobOffer::published()->count(),
            'draft' => JobOffer::draft()->count(),
            'expired' => JobOffer::expired()->count()
        ];

        return inertia('Panel/Dashboard', [
            'counts' => $counts
        ]);
    }
}
