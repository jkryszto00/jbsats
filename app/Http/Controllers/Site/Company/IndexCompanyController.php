<?php

namespace App\Http\Controllers\Site\Company;

use App\Domain\Company\ViewModels\SiteCompanyCollectionViewModel;

class IndexCompanyController
{
    public function __invoke()
    {
        return inertia('Site/Company/Index', [
            'model' => new SiteCompanyCollectionViewModel()
        ]);
    }
}
