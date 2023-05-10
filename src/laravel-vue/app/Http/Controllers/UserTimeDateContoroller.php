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
    public function index(): JsonResponse
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
        $created = UserTimeDate::create($data);
        $coll = collect($created);
        if (!$coll->has("description")) $created["description"] = null;
        if (!$coll->has("group_id")) $created["group_id"] = null;
        return response()->json(["data" => $created],201);
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
        if (array_key_exists('group_id',$data)) $date->group_id = $data["group_id"];
        if (array_key_exists('name',$data))  $date->name = $data["name"];
        if (array_key_exists('start',$data))  $date->start = $data["start"];
        if (array_key_exists('end',$data))  $date->end = $data["end"];
        if (array_key_exists('description',$data))  $date->description = $data["description"];
        $date->save();
        return response()->json(["data" => $date],200);
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
