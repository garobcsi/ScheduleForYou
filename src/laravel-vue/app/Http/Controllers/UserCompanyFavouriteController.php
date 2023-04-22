<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublicCompanyResource;
use App\Models\Company;
use App\Models\User;
use App\Models\UserCompanyFavourite;
use Illuminate\Http\Request;

class UserCompanyFavouriteController extends Controller
{
    public function index() {
        return response()->json(["data" => auth('sanctum')->user()->CompanyFavourite],200);
    }

    public function indexWithCompany() {
        $id = auth('sanctum')->user()->id;
        return PublicCompanyResource::collection(Company::whereRelation('CompanyFavourite','user_id',$id)->get());
    }

    public function isItFavourite(Company $company) {
        if(auth('sanctum')->user()->CompanyFavourite->where('company_id',$company->id)->count() === 0) return response()->json(["message"=> "Not a favourite."],200);
        return response()->json(["message"=> "It's a favourite."],200);
    }

    public function add(Company $company) {
        $user_id = auth('sanctum')->user()->id;
        $company_id = $company->id;
        if (UserCompanyFavourite::all()->where('user_id',$user_id)->where('company_id',$company_id)->count() !== 0) return response()->json(["message" => "Data already exists !"],403);
        UserCompanyFavourite::create(["user_id" => $user_id,"company_id" => $company_id]);
        return response()->json(["message" => "Data added successfully."],200);
    }

    public function remove(UserCompanyFavourite $favourite) {
        $this->authorize('isAuthorized',$favourite);
        $favourite->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
