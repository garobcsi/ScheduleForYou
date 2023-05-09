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
        UserTimeRoutine::create($data);
        return response()->json(["data" => "Data created successfully."],201);
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
        $date->group_id = $data["group_id"];
        $date->name = $data["name"];
        $date->start = $data["start"];
        $date->end = $data["end"];
        $date->repeat_time = $data["repeat_time"];
        $date->description = $data["description"];
        $date->save();
        return response()->json(["message" => "Data updated successfully."],200);
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
