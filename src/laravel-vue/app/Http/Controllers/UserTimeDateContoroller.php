<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeDateRequest;
use App\Http\Resources\TimeDateWithGroupsResource;
use App\Models\UserTimeDate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTimeDateContoroller extends Controller
{
    /**
     * Gets dates
     *
     * @return JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeDate],200);
    }

    /**
     * Show data with groups
     *
     * @return JsonResponse
     */
    public function indexWithGroups(): JsonResponse
    {
        return response()->json(["data" => TimeDateWithGroupsResource::collection(auth('sanctum')->user()->TimeDate)],200);
    }

    /**
     * Shows a single date
     *
     * @param UserTimeDate $date
     * @return JsonResponse
     */
    public function show(UserTimeDate $date): JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeDate->where('id',$date->id)],200);
    }

    /**
     * Stores date
     *
     * @param TimeDateRequest $request
     * @return JsonResponse
     */
    public function store(TimeDateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $data["user_id"] = $id;
        UserTimeDate::create($data);
        return response()->json(["data" => "Data created successfully."],201);
    }

    /**
     * Updates date
     *
     * @param TimeDateRequest $request
     * @param UserTimeDate $date
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(TimeDateRequest $request, UserTimeDate $date): JsonResponse
    {
        $this->authorize('isAuthorized',$date);
        $data = $request->validated();
        $date->group_id = $data["group_id"];
        $date->name = $data["name"];
        $date->start = $data["start"];
        $date->end = $data["end"];
        $date->description = $data["description"];
        $date->save();
        return response()->json(["message" => "Data updated successfully."],200);
    }

    /**
     * Destorys date
     *
     * @param UserTimeDate $date
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(UserTimeDate $date): JsonResponse
    {
        $this->authorize('isAuthorized',$date);
        $date->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
