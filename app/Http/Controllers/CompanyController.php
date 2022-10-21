<?php

namespace App\Http\Controllers;

use App\Dto\CompanyDto;
use App\Models\Company;
use App\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create(Request $request, CompanyService $companyService)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required|numeric|exists:users,id',
            'phone' => 'required|numeric|unique:companies'
        ]);

        $company = $companyService->create(
            CompanyDto::createFromRequest($request)
        );

        return new CompanyResource($company);
    }

    public function view()
    {
        return CompanyResource::collection(
            Company::query()->with('user')->paginate()
        );
    }
}
