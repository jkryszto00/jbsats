<?php

namespace App\Http\Controllers\Panel\Company;

use App\Domain\Company\Actions\UpdateCompanyAction;
use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Requests\UpdateCompanyRequest;
use App\Http\Controllers\Controller;

class UpdateCompanyController extends Controller
{
    public function __invoke(UpdateCompanyRequest $request, UpdateCompanyAction $updateCompanyAction)
    {
        $company = auth()->user()->company;
        $companyData = CompanyData::from($request->validated());

        $updateCompanyAction($company, $companyData);

        return redirect()->route('panel.company.show');
    }
}
