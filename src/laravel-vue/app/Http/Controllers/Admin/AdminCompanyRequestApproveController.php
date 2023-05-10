<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CompanyRequestStatusEnum;
use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAddCompanyApprovedTypeRequest;
use App\Models\CompanyApprovedType;
use App\Models\CompanyRequestType;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(title="Schedule For You API Docs", version="1.0")
 */
class AdminCompanyRequestApproveController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/admin/company/request",
     *   summary="Get All Type Requests",
     *   security={{"bearer_token":{}}},
     *   tags={"Admin Company Type Requests"},
     *   @OA\Response(
     *     response=401,
     *     description="No valid Bearer Token was provided.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="Unauthenticated."),
     *     )
     *   ),
     *   @OA\Response(
     *     response=403,
     *     description="You are not an admin.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="You don't have access !"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Data Returned."
     *   ),
     * )
     *
     * Get All Type Requests
     *
     * @return JsonResponse
     */
    public function getRequests(): \Illuminate\Http\JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        return response()->json(["data" => CompanyRequestType::all()],200);
    }

    /**
     * @OA\Get(
     *   path="/api/admin/company/request/pending",
     *   summary="Get All Pending Type Requests",
     *   security={{"bearer_token":{}}},
     *   tags={"Admin Company Type Requests"},
     *   @OA\Response(
     *     response=401,
     *     description="No valid Bearer Token was provided.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="Unauthenticated."),
     *     )
     *   ),
     *   @OA\Response(
     *     response=403,
     *     description="You are not an admin.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="You don't have access !"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Data Returned."
     *   ),
     * )
     * Get All Pending Type Requests
     *
     * @return JsonResponse
     */
    public function getPendingRequests(): JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        return response()->json(["data" => CompanyRequestType::all()->where('status',CompanyRequestStatusEnum::Pending->value)],200);
    }

    /**
     * @OA\Post(
     *   path="/api/admin/company/request",
     *   summary="Add a Company Type to Approved list",
     *   security={{"bearer_token":{}}},
     *   tags={"Admin Company Type Requests"},
     *   @OA\Response(
     *     response=401,
     *     description="No valid Bearer Token was provided.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="Unauthenticated."),
     *     )
     *   ),
     *   @OA\Response(
     *     response=403,
     *     description="You are not an admin.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="You don't have access !"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Incorrect data Sent."
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Data created.",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", format="text", example="Data created successfully."),
     *     )
     *   ),
     *   @OA\RequestBody(
     *      @OA\JsonContent(
     *       required={"name","lang"},
     *       @OA\Property(property="name", type="string", format="text", example="your type name"),
     *       @OA\Property(property="lang", type="string", format="text", example="hu|en"),
     *    )
     *   )
     * )
     * Add a Company Type
     *
     * @param AdminAddCompanyApprovedTypeRequest $request
     * @return JsonResponse
     */
    public function add(AdminAddCompanyApprovedTypeRequest $request): JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        $data = $request->validated();
        if (CompanyApprovedType::all()->where('name',$data["name"])->where('lang',$data["lang"])->count() === 0) CompanyApprovedType::create($data);
        return response()->json(["message" => "Data created successfully."],201);
    }

    /**
     * Remove a Company Type
     *
     * @param CompanyApprovedType $type
     * @return JsonResponse
     */
    public function remove(CompanyApprovedType $type): JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        $type->delete();
        return response()->json(["message" => "Data removed successfully."],200);
    }

    /**
     * Approve Type Request
     *
     * @param CompanyRequestType $type
     * @return JsonResponse
     */
    public function Approve(CompanyRequestType $type): JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        if ($type->status !== CompanyRequestStatusEnum::Pending->value) return response()->json(["message" => "Request is not pending !"],403);
        $type->status = CompanyRequestStatusEnum::Approved->value;
        $type->save();
        if(CompanyApprovedType::all()->where('name',$type->requested_name)->where('lang',$type->lang)->count() === 0) CompanyApprovedType::create(["name" => $type->requested_name,"lang" => $type->lang]);
        return response()->json(["message" => "Request approved successfully."],201);
    }

    /**
     * Deny Type Request
     *
     * @param CompanyRequestType $type
     * @return JsonResponse
     */
    public function Denies(CompanyRequestType $type): JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        if ($type->status !== CompanyRequestStatusEnum::Pending->value) return response()->json(["message" => "Request is not pending !"],403);
        $type->status = CompanyRequestStatusEnum::Denied->value;
        $type->save();
        return response()->json(["message" => "Request denied successfully."],201);

    }

    /**
     * Approve Type Request But rename it
     *
     * @param AdminAddCompanyApprovedTypeRequest $request
     * @param CompanyRequestType $type
     * @return JsonResponse
     */
    public function Rename(AdminAddCompanyApprovedTypeRequest $request, CompanyRequestType $type): JsonResponse
    {
        if(auth('sanctum')->user()->role !== UserRoleEnum::Admin->value) return response()->json(["message" => "You don't have access !"],403);
        if ($type->status !== CompanyRequestStatusEnum::Pending->value) return response()->json(["message" => "Request is not pending !"],403);
        $data = $request->validated();
        $type->renamed_name = $data["name"];
        $type->lang = $data["lang"];
        $type->status = CompanyRequestStatusEnum::Renamed->value;
        $type->save();
        if(CompanyApprovedType::all()->where('name',$data["name"])->where('lang',$data["lang"])->count() === 0) CompanyApprovedType::create(["name" => $data["name"],"lang" => $data["lang"]]);
        return response()->json(["message" => "Request renamed successfully."],201);
    }
}
