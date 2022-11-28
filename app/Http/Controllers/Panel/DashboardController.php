<?php

namespace App\Http\Controllers\Panel;

use App\Domain\Apply\Models\Apply;
use App\Domain\JobOffer\Models\JobOffer;
use App\Domain\Shared\ViewModels\PanelDashboardViewModel;
use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __invoke(): InertiaResponse
    {
        return inertia('Panel/Dashboard', [
            'model' => new PanelDashboardViewModel()
        ]);
    }
}
