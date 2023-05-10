<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublicCompanyResource;
use App\Models\Company;
use App\Models\User;
use App\Models\UserCompanyFavourite;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCompanyFavouriteController extends Controller
{
    /**
     * Get Favourite Companies
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->CompanyFavourite],200);
    }

    /**
     * Get companies where user set the companies to favourite
     *
     * @return JsonResponse
     */
    public function indexWithCompany(): JsonResponse
    {
        $id = auth('sanctum')->user()->id;
        return response()->json(["data" => PublicCompanyResource::collection(Company::whereRelation('CompanyFavourite','user_id',$id)->get())],200);
    }

    /**
     * Tell if company is users favourite
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function isItFavourite(Company $company): JsonResponse
    {
        if(auth('sanctum')->user()->CompanyFavourite->where('company_id',$company->id)->count() === 0) return response()->json(["message"=> "Not a favourite."],200);
        return response()->json(["message"=> "It's a favourite."],200);
    }

    /**
     * Add a Favourite
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function add(Company $company): JsonResponse
    {
        $user_id = auth('sanctum')->user()->id;
        $company_id = $company->id;
        if (UserCompanyFavourite::all()->where('user_id',$user_id)->where('company_id',$company_id)->count() !== 0) return response()->json(["message" => "Data already exists !"],403);
        UserCompanyFavourite::create(["user_id" => $user_id,"company_id" => $company_id]);
        return response()->json(["message" => "Data added successfully."],200);
    }

    /**
     * Removes a favourite
     *
     * @param UserCompanyFavourite $favourite
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function remove(UserCompanyFavourite $favourite): JsonResponse
    {
        $this->authorize('isAuthorized',$favourite);
        $favourite->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
