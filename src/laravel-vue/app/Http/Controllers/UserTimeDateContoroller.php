<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeDateRequest;
use App\Models\UserTimeDate;
use Illuminate\Http\Request;

class UserTimeDateContoroller extends Controller
{
    public function index()
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeDate],200);
    }

    public function show(UserTimeDate $date)
    {
        return response()->json(["data" => auth('sanctum')->user()->TimeDate->where('id',$date->id)],200);
    }

    public function store(TimeDateRequest $request)
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $data["user_id"] = $id;
        UserTimeDate::create($data);
        return response()->json(["data" => "Data created successfully."],201);
    }

    public function update(TimeDateRequest $request, UserTimeDate $date)
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

    public function destroy(UserTimeDate $date)
    {
        $this->authorize('isAuthorized',$date);
        $date->delete();
        return response()->json(["message" => "Data deleted successfully."],200);
    }
}
