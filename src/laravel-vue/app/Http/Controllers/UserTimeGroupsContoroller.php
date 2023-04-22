<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeGroupsRequest;
use App\Models\UserTimeGroups;
use Illuminate\Http\Request;

class UserTimeGroupsContoroller extends Controller
{
    public function index()
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeGroups],200);
    }

    public function show(UserTimeGroups $date)
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeGroups->where('id',$date->id)],200);
    }

    public function store(TimeGroupsRequest $request)
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $data["user_id"] = $id;
        UserTimeGroups::create($data);
        return response()->json(["data" => "Data created successfully."],201);
    }

    public function update(TimeGroupsRequest $request, UserTimeGroups $date)
    {
        $this->authorize('isAuthorized',$date);
        $data = $request->validated();
        $date->name = $data["name"];
        $date->color = $data["color"];
        $date->save();
        return response()->json(["message" => "Data updated successfully."],200);
    }

    public function destroy(UserTimeGroups $date)
    {
        $this->authorize('isAuthorized',$date);
        $date->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
