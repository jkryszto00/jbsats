<?php

namespace App\Http\Controllers\Panel\Company;

use App\Domain\Company\Actions\CreateCompanyAction;
use App\Domain\Company\Data\CompanyData;
use App\Domain\Company\Requests\CreateCompanyRequest;
use App\Domain\Shared\Services\UploadService;
use App\Domain\User\Data\UserData;

class StoreCompanyController
{
    public function __invoke(CreateCompanyRequest $request, UploadService $uploadService)
    {
        $logo = $uploadService->logo($request->file('image'));
        $owner = UserData::from(auth()->user());
        $company = CompanyData::from($request->validated());

        CreateCompanyAction::execute(
            owner: $owner,
            logo: $logo,
            company:$company
        );

        return redirect()->route('panel.company.show');
    }
}
