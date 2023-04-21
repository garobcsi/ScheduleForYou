<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function get() {
        return response()->json(["data" => UserSettings::all()->where('user_id',auth('sanctum')->user()->id)->first()],200);
    }
    public function update(UpdateUserSettingsRequest $request) {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $settings = UserSettings::findOrFail($id);
        $settings->lang = $data["lang"];
        $settings->theme = $data["theme"];
        $settings->save();
        return response()->json(["message" => "Data updated successfully."],200);
    }
}
