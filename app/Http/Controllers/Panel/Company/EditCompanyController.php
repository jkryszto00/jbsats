<?php

namespace App\Http\Controllers\Panel\Company;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Resources\CompanyResource;
use App\Http\Controllers\Controller;

class EditCompanyController extends Controller
{
    public function __invoke()
    {
        $company = Company::findOrFail(1);

        return inertia('Panel/Company/Edit', [
            'company' => new CompanyResource($company)
        ]);
    }
}
