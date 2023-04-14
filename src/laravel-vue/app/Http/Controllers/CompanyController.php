<?php

namespace App\Http\Controllers;

use App\Enums\CompanyPermissionEnum;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\PublicCompanyResource;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Get all tables
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return PublicCompanyResource::collection(Company::all());
    }

    /**
     * Show existing Company Table by index
     *
     * @param  \App\Models\Company  $company
     * @return PublicCompanyResource
     */
    public function show(Company $company)
    {
        return new PublicCompanyResource($company);
    }

    /**
     * Get back user tables and permissions
     *
     * @return void
     */
    public function my()
    {
        //get back user permission and its tables
    }

    /**
     * The creator of the Table can add Users to the Table
     *
     * @return void
     */
    public function addUserPermission() {

    }

    /**
     * Create new Company Table
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanyRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $created = Company::create($data);
        $created->permissions()->attach(auth('sanctum')->user()->id,['permission'=>CompanyPermissionEnum::Owner]);
        return response()->json(["message" =>"Created Successfully."],201);
    }


    /**
     * Change existing Company Table
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Delete existing Company Table
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
