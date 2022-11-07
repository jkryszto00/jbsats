<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __invoke(): InertiaResponse
    {
        return inertia('Panel/Dashboard');
    }
}
