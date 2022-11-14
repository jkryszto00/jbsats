<?php

namespace App\Http\Controllers\Site\Company;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Resources\CompanyResource;

class IndexCompanyController
{
    public function __invoke()
    {
        $companies = Company::withCount('jobOffers')->get();
        $companiesCount = $companies->count();

        return inertia('Site/Company/Index', [
            'companies' => CompanyResource::collection($companies),
            'companiesCount' => $companiesCount
        ]);
    }
}
