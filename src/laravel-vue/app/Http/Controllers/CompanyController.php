<?php

namespace App\Http\Controllers;

use App\Enums\CompanyPermissionEnum;
use App\Http\Requests\ContributorCompanyRequest;
use App\Http\Requests\FindUserRequest;
use App\Http\Requests\CompanyRequest;
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
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompanyRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $created = Company::create($data);
        $created->permissions()->attach(auth('sanctum')->user()->id,['permission'=>CompanyPermissionEnum::Owner]);
        return response()->json(["message" =>"Created Successfully."],201);
    }

    /**
     * Change existing Company Table
     *
     * @param  \App\Http\Requests\CompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return JsonResponse
     */
    public function update(CompanyRequest $request, Company $company): JsonResponse
    {
        $data = $request->validated();
        $company->name = $data["name"];
        $company->introduce = $data["introduce"];
        $company->email = $data["email"];
        $company->tel = $data["tel"];
        $company->address = $data["address"];
        $company->save();
        return response()->json([
            "data" => ["message" => "Data updated successfully."]
        ],201);
    }

    /**
     * Delete existing Company Table
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // update it when other things should be destroyed too
        $company->permissions()->where("company_id",$company->id)->detach();
        $company->delete($company->id);
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
     * @param ContributorCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function addContributor(ContributorCompanyRequest $request, Company $company): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = User::all()->where('email',$data["email"]);
        if ($user->count() === 0) return response()->json(['message'=>'User dosen\'t exist !'],404);
        $id = $user->first()->id;
        $pivot = $company->permissions()->where('company_id',$company->id);
        if ($pivot->where('user_id',$id)->count() !==0) return response()->json(['message'=>"User is already a contributor !"],403);
        $pivot->detach([$id]);
        $enum = CompanyPermissionEnum::tryFrom($data["permission"]);
        $company->permissions()->attach($id,['permission'=>$enum->value]);
        return response()->json(['message'=>"User added as ".$enum->name."."],201);
    }

    /**
     * Update the existing Contributor Users
     *
     * @param ContributorCompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateContributorPerms(ContributorCompanyRequest $request, Company $company): JsonResponse
    {
        $data = $request->validated();
        $user = User::all()->where('email',$data["email"]);
        if ($user->count() === 0) return response()->json(['message'=>'User dosen\'t exist !'],404);
        $id = $user->first()->id;
        $permUser = $company->permissions()->where('user_id',$id)->where('company_id',$company->id);
        if ($permUser->count() === 0) return response()->json(['message'=>"User is not already a contributor !"],403);
        if ($permUser->first()->pivot->permission === CompanyPermissionEnum::Owner->value) return response()->json(['message'=>CompanyPermissionEnum::Owner->name." user permission cannot be changed !"],403);
        $enum = CompanyPermissionEnum::tryFrom($data["permission"]);
        $company->permissions()->updateExistingPivot($id, [
            'permission' => $enum->value,
        ]);
        return response()->json(['message'=>"User permission changed to ".$enum->name."."],200);
    }

    /**
     * User leaves Being as a Contributor
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function leaveContributor(Company $company) {
        $id = auth('sanctum')->user()->id;
        if ($company->permissions()->where('company_id',$company->id)->where('user_id',$id)->count() === 0) return response()->json(['message'=>"You are not a contributor !"],403);
        $permUser = $company->permissions()->where('user_id',$id)->where('company_id',$company->id);
        if ($permUser->first()->pivot->permission === CompanyPermissionEnum::Owner->value) return response()->json(['message'=>CompanyPermissionEnum::Owner->name." user can't leave !"],403);
        $pivot = $company->permissions()->where('company_id',$company->id);
        $pivot->detach([$id]);
        return response()->json(['message'=>'Leave successful.'],200);
    }

    /**
     * Kick user front being as a Contributor
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function kickContributor(FindUserRequest $request,Company $company) {
        $data = $request->validated();
        $user = User::all()->where('email',$data["email"]);
        $id = $user->first()->id;
        if ($user->count() === 0) return response()->json(['message'=>'User dosen\'t exist !'],404);
        if ($company->permissions()->where('company_id',$company->id)->where('user_id',$id)->count() === 0) return response()->json(['message'=>"User is not a contributor !"],403);
        $permUser = $company->permissions()->where('user_id',$id)->where('company_id',$company->id);
        if ($permUser->first()->pivot->permission === CompanyPermissionEnum::Owner->value) return response()->json(['message'=>CompanyPermissionEnum::Owner->name." user can't leave !"],403);
        $pivot = $company->permissions()->where('company_id',$company->id);
        $pivot->detach([$id]);
        return response()->json(['message'=>'User removed successfully.'],200);
    }
}
