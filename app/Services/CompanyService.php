<?php

namespace App\Services;

use App\Dto\CompanyDto;
use App\Models\Company;

class CompanyService
{
    public function create(CompanyDto $companyDto): Company
    {
        // Some save logic ...
        $company = new Company();
        $company->title = $companyDto->title;
        $company->description = $companyDto->description;
        $company->phone = $companyDto->phone;
        $company->user_id = $companyDto->userId;
        $company->save();

        return $company->load('user');
    }
}
