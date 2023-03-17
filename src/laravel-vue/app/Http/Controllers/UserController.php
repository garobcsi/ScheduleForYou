<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Register(RegisterRequest $request) {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        User::create($data);
        return response()->json(["message" => "Registration Success."],200);
    }
    public function Login(LoginRequest $request) {
        if(Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                "data" => [ "token" => $token ]
            ],200);
        }
        else {
            return response()->json(["message" => "Login Unsuccessful."],401);
        }
    }
    public function IsLoginValid(Request $request) {
        return response()->json(["message" => "Authenticated."],200);
    }
    public function KeepTokenAlive() {

    }
    public function Logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message" => "Logout Success."],200);
    }
    public function LogoutAll(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Logout All Success."],200);
    }
}
