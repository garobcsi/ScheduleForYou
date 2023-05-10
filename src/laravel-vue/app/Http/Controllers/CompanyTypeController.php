<?php

namespace App\Http\Controllers;

use App\Enums\CompanyRequestStatusEnum;
use App\Enums\LangEnum;
use App\Http\Requests\AddCompanyTypeRequestRequest;
use App\Models\Company;
use App\Models\CompanyApprovedType;
use App\Models\CompanyRequestType;
use App\Models\CompanyType;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CompanyTypeController extends Controller
{
    /**
     * Get All Aproved Types
     * 
     * @return JsonResponse
     */
    public function getTypes(): \Illuminate\Http\JsonResponse
    {
        return response()->json(["data"=>CompanyApprovedType::all()],200);
    }

    /**
     * Get All Aproved Types By Language
     * 
     * @param $lang
     * @return JsonResponse
     */
    public function getTypesByLang($lang): JsonResponse
    {
        if(!in_array($lang,array_column(LangEnum::cases(), 'value'))) return response()->json(["message"=>"Language doesn't exist !"],404);
        return response()->json(["data"=>CompanyApprovedType::all()->where('lang',$lang)],200);
    }

    /**
     * Add a Type To Company
     * 
     * @param Company $company
     * @param CompanyApprovedType $type
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function add(Company $company, CompanyApprovedType $type): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        if (CompanyType::all()->where('company_id',$company->id)->where('type_id',$type->id)->count() !== 0) return response()->json(["message" => "This data already exists !"],404);
        CompanyType::create(["company_id" =>$company->id,"type_id" => $type->id]);
        return response()->json(["message"=>"Data added successfully."],200);
    }

    /**
     * Remove a Type From Company
     * 
     * @param Company $company
     * @param CompanyApprovedType $type
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function remove(Company $company, CompanyApprovedType $type): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = CompanyType::all()->where('company_id',$company->id)->where('type_id',$type->id);
        if ($data->count() === 0) return response()->json(["message" => "This data doesn't exists !"],404);
        $data->first()->delete();
        return response()->json(["message" => "Data removed successfully."],200);
    }

    /**
     * Get submited Requests
     * 
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function getRequests(Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        return response()->json(["data" => CompanyRequestType::all()->where('company_id',$company)],200);
    }

    /**
     * Add a Type Request
     * 
     * @param AddCompanyTypeRequestRequest $request
     * @param Company $company
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function addTypeRequest(AddCompanyTypeRequestRequest $request, Company $company): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        if (CompanyRequestType::all()->where('company_id',$company->id)->where('status',CompanyRequestStatusEnum::Pending->value)->count() >= 2) return response()->json(["message"=>"You can't submit more !"],403);
        $data = $request->validated();
        $data["company_id"] = $company->id;
        $data["status"] = CompanyRequestStatusEnum::Pending;
        CompanyRequestType::create($data);
        return response()->json(["message" => "Submission sent successfully."],201);
    }

    /**
     * Cancel a Type Request
     * 
     * @param Company $company
     * @param CompanyRequestType $type
     * @return Response|JsonResponse|Application|ResponseFactory
     * @throws AuthorizationException
     */
    public function removeTypeRequest(Company $company, CompanyRequestType $type): \Illuminate\Http\Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = CompanyRequestType::all()->where('company_id',$company->id)->where('id',$type->id);
        if ($data->count() === 0) return response(["message" => "This data doesn't exists !"],404);
        $data=$data->first();
        if ($data->status === CompanyRequestStatusEnum::Canceled->value) return response()->json(["message" => "Submission is already canceled !"],403);
        $data->status = CompanyRequestStatusEnum::Canceled;
        $data->save();
        return response()->json(["message" => "Submission canceled successfully."],200);
    }
}
