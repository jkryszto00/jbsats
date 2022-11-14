<?php

namespace App\Http\Controllers\Site\Company;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Resources\CompanyResource;

class ShowCompanyController
{
    public function __invoke(Company $company)
    {
        return inertia('Site/Company/Show', [
            'company' => new CompanyResource($company)
        ]);
    }
}
