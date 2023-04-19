<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function Register(RegisterRequest $request) {
        if(!in_array($request->host(),["localhost","127.0.0.1"])) return response()->json(["message" => "Cannot create account on ".$request->host()],403);
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        $data["role"] = UserRoleEnum::Admin;
        User::create($data);
        return response()->json(["message" => "Registration Success."],200);
    }
}
