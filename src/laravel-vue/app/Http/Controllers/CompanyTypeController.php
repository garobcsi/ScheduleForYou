<?php

namespace App\Http\Controllers;

use App\Enums\LangEnum;
use App\Models\Company;
use App\Models\CompanyApprovedType;
use App\Models\CompanyRequestType;
use App\Models\CompanyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyTypeController extends Controller
{
    public function getTypes() {
        return response()->json(["data"=>CompanyApprovedType::all()],200);
    }

    public function getTypesByLang($lang) {
        if(!in_array($lang,array_column(LangEnum::cases(), 'value'))) return response()->json(["message"=>"Language doesn't exist !"],403);
        return response()->json(["data"=>CompanyApprovedType::all()->where('lang',$lang)],200);
    }

    public function add(Company $company,CompanyApprovedType $type) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        if (CompanyType::all()->where('company_id',$company->id)->where('type_id',$type->id)->count() !== 0) return response(["message" => "This data already exists !"],403);
        CompanyType::create(["company_id" =>$company->id,"type_id" => $type->id]);
        return response()->json(["message"=>"Data added successfully."],200);
    }

    public function remove(Company $company,CompanyApprovedType $type) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = CompanyType::all()->where('company_id',$company->id)->where('type_id',$type->id);
        if ($data->count() === 0) return response(["message" => "This data doesn't exists !"],403);
        $data->first()->delete();
        return response()->json(["message" => "Data removed successfully."],200);
    }

    public function getRequests(Company $company) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);

    }

    public function addTypeRequest(Company $company) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);

        //user can request a type if it isn't exitst
    }

    public function removeTypeRequest(Company $company,CompanyRequestType $type) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        //user can remove its own request
    }
}
