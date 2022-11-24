<?php

namespace App\Http\Controllers\Site\Company;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Resources\CompanyResource;
use App\Domain\Company\ViewModels\SiteShowCompanyViewModel;

class ShowCompanyController
{
    public function __invoke(Company $company)
    {
        return inertia('Site/Company/Show', [
            'model' => new SiteShowCompanyViewModel($company)
        ]);
    }
}
