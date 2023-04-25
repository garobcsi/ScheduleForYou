<?php

namespace App\Http\Controllers;

use App\Enums\CompanyRequestStatusEnum;
use App\Enums\LangEnum;
use App\Http\Requests\AddCompanyTypeRequestRequest;
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
        if(!in_array($lang,array_column(LangEnum::cases(), 'value'))) return response()->json(["message"=>"Language doesn't exist !"],404);
        return response()->json(["data"=>CompanyApprovedType::all()->where('lang',$lang)],200);
    }

    public function add(Company $company,CompanyApprovedType $type) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        if (CompanyType::all()->where('company_id',$company->id)->where('type_id',$type->id)->count() !== 0) return response(["message" => "This data already exists !"],404);
        CompanyType::create(["company_id" =>$company->id,"type_id" => $type->id]);
        return response()->json(["message"=>"Data added successfully."],200);
    }

    public function remove(Company $company,CompanyApprovedType $type) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = CompanyType::all()->where('company_id',$company->id)->where('type_id',$type->id);
        if ($data->count() === 0) return response(["message" => "This data doesn't exists !"],404);
        $data->first()->delete();
        return response()->json(["message" => "Data removed successfully."],200);
    }

    public function getRequests(Company $company) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        return response()->json(["data" => CompanyRequestType::all()->where('company_id',$company)],200);
    }

    public function addTypeRequest(AddCompanyTypeRequestRequest $request,Company $company) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        if (CompanyRequestType::all()->where('company_id',$company->id)->where('status',CompanyRequestStatusEnum::Pending->value)->count() >= 2) return response()->json(["message"=>"You can't submit more !"],403);
        $data = $request->validated();
        $data["company_id"] = $company->id;
        $data["status"] = CompanyRequestStatusEnum::Pending;
        CompanyRequestType::create($data);
        return response()->json(["message" => "Submission sent successfully."],201);
    }

    public function removeTypeRequest(Company $company,CompanyRequestType $type) {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = CompanyRequestType::all()->where('company_id',$company->id)->where('id',$type->id);
        if ($data->count() === 0) return response(["message" => "This data doesn't exists !"],404);
        $data=$data->first();
        if ($data->status === CompanyRequestStatusEnum::Canceled->value) return response(["message" => "Submission is already canceled !"],403);
        $data->status = CompanyRequestStatusEnum::Canceled;
        $data->save();
        return response()->json(["message" => "Submission canceled successfully."],200);
    }
}
