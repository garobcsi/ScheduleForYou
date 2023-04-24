<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CompanyRequestStatusEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAddCompanyApprovedTypeRequest;
use App\Models\CompanyApprovedType;
use App\Models\CompanyRequestType;

class AdminCompanyRequestApproveController extends Controller
{
    public function getRequests() {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        return response()->json(["data" => CompanyRequestType::all()],200);
    }

    public function getPendingRequests() {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        return response()->json(["data" => CompanyRequestType::all()->where('status',CompanyRequestStatusEnum::Pending->value)],200);
    }

    public function add(AdminAddCompanyApprovedTypeRequest $request) {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        $data = $request->validated();
        if(CompanyApprovedType::all()->where('name',$data["name"])->where('lang',$data["lang"])->count() !== 0) {
            return response()->json(["message" => "Data already exists !"],403);
        };
        CompanyApprovedType::create($data);
        return response()->json(["message" => "Data created successfully."],201);
    }

    public function remove(CompanyApprovedType $type) {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        $type->delete();
        return response()->json(["message" => "Data removed successfully."],200);
    }

    public function Approve(CompanyRequestType $type) {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        if ($type->status !== CompanyRequestStatusEnum::Pending->value) return response()->json(["message" => "Request is not pending !"],403);
        $type->status = CompanyRequestStatusEnum::Approved->value;
        $type->save();
        if(CompanyApprovedType::all()->where('name',$type->requested_name)->where('lang',$type->lang)->count() !== 0) {
            return response()->json(["message" => "Data already exists !"],403);
        };
        CompanyApprovedType::create(["name" => $type->requested_name,"lang" => $type->lang]);
        return response()->json(["message" => "Request approved successfully."],201);
    }

    public function Denies(CompanyRequestType $type) {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        if ($type->status !== CompanyRequestStatusEnum::Pending->value) return response()->json(["message" => "Request is not pending !"],403);
        $type->status = CompanyRequestStatusEnum::Denied->value;
        $type->save();
        return response()->json(["message" => "Request denied successfully."],201);

    }

    public function Rename(AdminAddCompanyApprovedTypeRequest $request,CompanyRequestType $type) {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        if ($type->status !== CompanyRequestStatusEnum::Pending->value) return response()->json(["message" => "Request is not pending !"],403);
        $data = $request->validated();
        $type->renamed_name = $data["name"];
        $type->lang = $data["lang"];
        $type->status = CompanyRequestStatusEnum::Renamed->value;
        $type->save();
        if(CompanyApprovedType::all()->where('name',$data["name"])->where('lang',$data["lang"])->count() !== 0) {
            return response()->json(["message" => "Data already exists !"],403);
        };
        CompanyApprovedType::create(["name" => $data["name"],"lang" => $data["lang"]]);
        return response()->json(["message" => "Request renamed successfully."],201);
    }
}
