<?php

namespace App\Http\Controllers\Panel\Company;

use App\Domain\Company\Actions\CreateCompanyAction;
use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Requests\CreateCompanyRequest;
use App\Domain\User\Data\UserData;

class StoreCompanyController
{
    public function __invoke(CreateCompanyRequest $request, CreateCompanyAction $createCompanyAction)
    {
        $owner = UserData::from(auth()->user());
        $companyData = CompanyData::from($request);

        $createCompanyAction($owner, $companyData);

        return redirect()->route('panel.company.show');
    }
}
