<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    /**
     * Gets user settins
     *
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return response()->json(["data" => auth('sanctum')->user()->settings],200);
    }

    /**
     * Sets User settings
     *
     * @param UpdateUserSettingsRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserSettingsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $id = auth('sanctum')->user()->id;
        $settings = UserSettings::findOrFail($id);
        if (array_key_exists('lang',$data)) $settings->lang = $data["lang"];
        if (array_key_exists('theme',$data)) $settings->theme = $data["theme"];
        $settings->save();
        return response()->json(["message" => "Data updated successfully."],200);
    }
}
