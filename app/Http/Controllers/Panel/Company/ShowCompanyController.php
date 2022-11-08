<?php

namespace App\Http\Controllers\Panel\Company;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Resources\CompanyResource;
use App\Http\Controllers\Controller;

class ShowCompanyController extends Controller
{
    public function __invoke()
    {
        $company = Company::findOrFail(1);

        return inertia('Panel/Company/Show', [
            'company' => new CompanyResource($company)
        ]);
    }
}
