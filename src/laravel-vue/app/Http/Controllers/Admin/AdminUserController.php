<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Register an admin account
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function Register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        if(!in_array($request->host(),["localhost","127.0.0.1"])) return response()->json(["message" => "Cannot create account on ".$request->host()],403);
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        $data["role"] = UserRoleEnum::Admin;
        $user = User::create($data);
        UserSettings::create(["user_id" => $user->id]);
        return response()->json(["message" => "Registration Success."],200);
    }
}
