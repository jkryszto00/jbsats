<?php

namespace App\Http\Controllers\Panel\Company;

use Inertia\Response as InertiaResponse;

class CreateCompanyController
{
    public function __invoke(): InertiaResponse
    {
        return inertia('Panel/Company/Create');
    }
}
