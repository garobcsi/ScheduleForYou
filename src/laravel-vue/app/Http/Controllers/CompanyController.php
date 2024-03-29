<?php

namespace App\Http\Controllers;

use App\Enums\CompanyPermissionEnum;
use App\Http\Requests\ContributorCompanyRequest;
use App\Http\Requests\FindUserRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\AllContributorsCompanyResource;
use App\Http\Resources\MyCompanyResource;
use App\Http\Resources\PublicCompanyResource;
use App\Models\Company;
use App\Models\CompanyOpeningHours;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * Get all tables
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(["data" => PublicCompanyResource::collection(Company::all())],200);
    }

    /**
     * Show existing Company Table by index
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return response()->json(["data" => new PublicCompanyResource($company)],200);
    }

    /**
     * Create new Company Table
     *
     * @param CompanyRequest $request
     * @return JsonResponse
     */
    public function store(CompanyRequest $request): JsonResponse
    {
        $data = $request->validated();
        $created = Company::create($data);
        $created->permissions()->attach(auth('sanctum')->user()->id,['permission'=>CompanyPermissionEnum::Owner]);
        $createdOH = CompanyOpeningHours::create(['companies_id'=>$created->id]);
        return response()->json(["message" =>"Created Successfully."],201);
    }

    /**
     * Change existing Company Table
     *
     * @param CompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(CompanyRequest $request, Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = $request->validated();
        $company->name = $data["name"];
        $company->introduce = $data["introduce"];
        $company->email = $data["email"];
        $company->tel = $data["tel"];
        $company->address = $data["address"];
        $company->save();
        return response()->json(["message" => "Data updated successfully."],201);
    }

    /**
     * Delete existing Company Table
     *
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwner',$company);
        $company->delete();
        return response()->json(["message" => "Company deleted successfully."],200);
    }

    /**
     * Get back user tables and permissions
     *
     * @return JsonResponse
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
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function getAllContributors(Company $company): JsonResponse
    {
        $this->authorize('isContributor',$company);
        $data = User::whereHas('permissions', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->get();
        $resource = AllContributorsCompanyResource::collection($data);
        $resource->map(function($i) use ($company) { $i->company = $company->id; });
        return response()->json(["data" => $resource],200);
    }

    /**
     * The creator of the Table can add Users to the Table
     *
     * @param ContributorCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function addContributor(ContributorCompanyRequest $request, Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
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
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateContributorPerms(ContributorCompanyRequest $request, Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
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
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function leaveContributor(Company $company): JsonResponse
    {
        $this->authorize('isContributor',$company);
        $id = auth('sanctum')->user()->id;
        $permUser = $company->permissions()->where('user_id',$id)->where('company_id',$company->id);
        if ($permUser->first()->pivot->permission === CompanyPermissionEnum::Owner->value) return response()->json(['message'=>CompanyPermissionEnum::Owner->name." user can't leave !"],403);
        $pivot = $company->permissions()->where('company_id',$company->id);
        $pivot->detach([$id]);
        return response()->json(['message'=>'Leave successful.'],200);
    }


    /**
     * Kick user front being as a Contributor
     *
     * @param FindUserRequest $request
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function kickContributor(FindUserRequest $request, Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
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
