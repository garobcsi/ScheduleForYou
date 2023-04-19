<?php

namespace App\Policies;

use App\Enums\CompanyPermissionEnum;
use App\Enums\UserRoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function onlyOwnerCoOwnerManager(User $user,Company $company)
    {
        if ($user->role === UserRoleEnum::Admin->value) return Response::allow();
        $pivot = $company->permissions()->where('user_id',$user->id)->where('company_id',$company->id);
        if ($pivot->count() === 0) return Response::deny('You are not a contributor !');
        if (!in_array($pivot->first()->pivot->permission,array(CompanyPermissionEnum::Owner->value,CompanyPermissionEnum::CoOwner->value,CompanyPermissionEnum::Manager->value))) return Response::deny('You are don\'t have access !');
        return Response::allow();
    }
    public function onlyOwnerCoOwner(User $user,Company $company)
    {
        if ($user->role === UserRoleEnum::Admin->value) return Response::allow();
        $pivot = $company->permissions()->where('user_id',$user->id)->where('company_id',$company->id);
        if ($pivot->count() === 0) return Response::deny('You are not a contributor !');
        if (!in_array($pivot->first()->pivot->permission,array(CompanyPermissionEnum::Owner->value,CompanyPermissionEnum::CoOwner->value))) return Response::deny('You are don\'t have access !');
        return Response::allow();
    }
    public function isContributor(User $user,Company $company)
    {
        if ($user->role === UserRoleEnum::Admin->value) return Response::allow();
        $pivot = $company->permissions()->where('user_id',$user->id)->where('company_id',$company->id);
        if ($pivot->count() === 0) return Response::deny('You are not a contributor !');
        return Response::allow();
    }
}
