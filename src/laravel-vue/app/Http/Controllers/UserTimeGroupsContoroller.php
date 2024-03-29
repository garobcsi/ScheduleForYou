<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeGroupsRequest;
use App\Models\UserTimeGroups;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTimeGroupsContoroller extends Controller
{
    /**
     * Shows all group
     *
     * @return JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeGroups],200);
    }


    /**
     * Shows one group
     *
     * @param UserTimeGroups $date
     * @return JsonResponse
     */
    public function show(UserTimeGroups $date): JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeGroups->where('id',$date->id)],200);
    }

    /**
     * Creates a group
     *
     * @param TimeGroupsRequest $request
     * @return JsonResponse
     */
    public function store(TimeGroupsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $data["user_id"] = $id;
        UserTimeGroups::create($data);
        return response()->json(["data" => "Data created successfully."],201);
    }

    /**
     * Updates group
     *
     * @param TimeGroupsRequest $request
     * @param UserTimeGroups $date
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(TimeGroupsRequest $request, UserTimeGroups $date): JsonResponse
    {
        $this->authorize('isAuthorized',$date);
        $data = $request->validated();
        $date->name = $data["name"];
        $date->color = $data["color"];
        $date->save();
        return response()->json(["message" => "Data updated successfully."],200);
    }

    /**
     * Deletes a group
     *
     * @param UserTimeGroups $date
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(UserTimeGroups $date): JsonResponse
    {
        $this->authorize('isAuthorized',$date);
        $TimeDate = $date->date;
        foreach ($TimeDate as $i) {
            $i->group_id = null;
            $i->save();
        }
        $TimeRoutine = $date->routine;
        foreach ($TimeRoutine as $i) {
            $i->group_id = null;
            $i->save();
        }
        $date->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
