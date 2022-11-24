<?php

namespace App\Http\Controllers\Panel\Company;

use App\Domain\Company\Resources\CompanyResource;
use App\Domain\Company\ViewModels\UpsertCompanyViewModel;
use App\Http\Controllers\Controller;

class ShowCompanyController extends Controller
{
    public function __invoke()
    {
        $company = auth()->user()->company;

        return inertia('Panel/Company/Show', [
            'model' => new UpsertCompanyViewModel($company)
        ]);
    }
}
