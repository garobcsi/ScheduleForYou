<?php

namespace App\Http\Controllers;

use App\Enums\CompanyPermissionEnum;
use App\Http\Requests\AddContributorCompanyRequest;
use App\Http\Requests\FindUserRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\AllContributorsCompanyResource;
use App\Http\Resources\MyCompanyResource;
use App\Http\Resources\PublicCompanyResource;
use App\Http\Resources\PublicUserResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * Get all tables
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(PublicCompanyResource::collection(Company::all()),200);
    }

    /**
     * Show existing Company Table by index
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Company $company): \Illuminate\Http\JsonResponse
    {
        return response()->json(new PublicCompanyResource($company),200);
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

    /**
     * Get back user tables and permissions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function my(): JsonResponse
    {
        $id = auth('sanctum')->user()->id;
        $data = Company::whereRelation('permissions','user_id',$id)->get();
        return response()->json(MyCompanyResource::collection($data),200);
    }

    /**
     * Get all Contributors
     *
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllContributors(Company $company): JsonResponse
    {
        $data = User::whereHas('permissions', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->get();
        $resource = AllContributorsCompanyResource::collection($data);
        $resource->map(function($i) use ($company) { $i->company = $company->id; });
        return response()->json($resource,200);
    }

    /**
     * The creator of the Table can add Users to the Table
     *
     * @param AddContributorCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function addContributor(AddContributorCompanyRequest $request, Company $company): \Illuminate\Http\JsonResponse
    {
        $data = User::all()->where('email',$request->email);
        if ($data->count() === 0) return response()->json(['message'=>'User dosen\'t exist !'],404);
        $id = $data->first()->id;
        if ($company->permissions()->where('user_id',$id)->where('company_id',$company->id)->count() !==0) return response()->json(['message'=>"User is already a contributor."],403);
        $enum = CompanyPermissionEnum::tryFrom($request->permission);
        $company->permissions()->attach($id,['permission'=>$enum->value]);
        return response()->json(['message'=>"User added as ".$enum->name."."],201);

    }

    /**
     * Update the existing Contributor Users
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateContributorPerms() {

    }


    /**
     * User leaves Being as a Contributor
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function leaveContributor(Company $company) {
        // the owner cant leave
    }

    /**
     * Kick user front being as a Contributor
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function kickContributor() {

    }
}
