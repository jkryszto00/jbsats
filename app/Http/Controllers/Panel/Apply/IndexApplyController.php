<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\Models\Apply;
use App\Domain\Apply\ViewModels\PanelCollectionJobOfferApplyCountViewModel;
use App\Http\Controllers\Controller;

class IndexApplyController extends Controller
{
    public function __invoke()
    {
        $this->authorize('viewAny', Apply::class);

        return inertia('Panel/Apply/Index', [
            'model' => new PanelCollectionJobOfferApplyCountViewModel()
        ]);
    }
}
