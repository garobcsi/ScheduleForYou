<?php

namespace App\Http\Controllers;

use App\Enums\RepeatTimeEnum;
use App\Enums\RepeatTimeHUEnum;
use App\Http\Requests\TimeRoutineRequest;
use App\Http\Resources\TimeRoutineWithGroupsResource;
use App\Models\UserTimeRoutine;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTimeRoutineContoroller extends Controller
{
    /**
     * Get Routine Enum
     *
     * @return JsonResponse
     */
    public function enum(): JsonResponse
    {
        return response()->json(["data" => RepeatTimeEnum::array()],200);
    }

    /**
     * Get Routine Enum (In hungarian)
     *
     * @return JsonResponse
     */
    public function enumHU(): JsonResponse
    {
        return response()->json(["data" => RepeatTimeHUEnum::array()],200);
    }
    /**
     * Shows all routines
     *
     * @return JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeRoutine],200);
    }

    /**
     * Show all routines with all group associations
     *
     * @return JsonResponse
     */
    public function indexWithGroups(): JsonResponse
    {
        return response()->json(["data" => TimeRoutineWithGroupsResource::collection(auth('sanctum')->user()->TimeRoutine)],200);
    }

    /**
     * Show one Routine
     *
     * @param UserTimeRoutine $date
     * @return JsonResponse
     */
    public function show(UserTimeRoutine $date): JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeRoutine->where('id',$date->id)],200);
    }

    /**
     * Adds a Routine
     *
     * @param TimeRoutineRequest $request
     * @return JsonResponse
     */
    public function store(TimeRoutineRequest $request): JsonResponse
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $data["user_id"] = $id;
        $created = UserTimeRoutine::create($data);
        $coll = collect($created);
        if (!$coll->has("description")) $created["description"] = null;
        if (!$coll->has("group_id")) $created["group_id"] = null;
        return response()->json(["data" => $created],201);
    }

    /**
     * Updates a routine
     *
     * @param TimeRoutineRequest $request
     * @param UserTimeRoutine $date
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(TimeRoutineRequest $request, UserTimeRoutine $date): JsonResponse
    {
        $this->authorize('isAuthorized',$date);
        $data = $request->validated();
        if (array_key_exists('group_id',$data)) $date->group_id = $data["group_id"];
        if (array_key_exists('name',$data)) $date->name = $data["name"];
        if (array_key_exists('start',$data)) $date->start = $data["start"];
        if (array_key_exists('end',$data)) $date->end = $data["end"];
        if (array_key_exists('repeat_time',$data)) $date->repeat_time = $data["repeat_time"];
        if (array_key_exists('description',$data)) $date->description = $data["description"];
        $date->save();
        return response()->json(["data" => $date],200);
    }

    /**
     * Deletes a Routine
     *
     * @param UserTimeRoutine $date
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(UserTimeRoutine $date): JsonResponse
    {
        $this->authorize('isAuthorized',$date);
        $date->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
