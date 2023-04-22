<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRoutineRequest;
use App\Models\UserTimeRoutine;
use Illuminate\Http\Request;

class UserTimeRoutineContoroller extends Controller
{
    public function index()
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeRoutine],200);
    }

    public function show(UserTimeRoutine $date)
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeRoutine->where('id',$date->id)],200);
    }

    public function store(TimeRoutineRequest $request)
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $data["user_id"] = $id;
        UserTimeRoutine::create($data);
        return response()->json(["data" => "Data created successfully."],201);
    }

    public function update(TimeRoutineRequest $request, UserTimeRoutine $date)
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

    public function destroy(UserTimeRoutine $date)
    {
        $this->authorize('isAuthorized',$date);
        $date->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
