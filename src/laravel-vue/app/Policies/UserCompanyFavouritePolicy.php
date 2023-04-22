<?php

namespace App\Policies;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserCompanyFavourite;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserCompanyFavouritePolicy
{
    use HandlesAuthorization;

    public function isAuthorized(User $user,UserCompanyFavourite $company)
    {
        if ($user->role === UserRoleEnum::Admin->value) return Response::allow();
        if ($user->id !== $company->user_id) return Response::deny('You don\'t have access to this data !');
        return Response::allow();
    }
}
