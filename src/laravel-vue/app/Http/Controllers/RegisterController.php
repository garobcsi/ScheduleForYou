<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function Register(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            "name" => "required|max:255",
            "email" => "required|max:255|unique:users,email|email",
            "password" => "required|max:255",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                "data" => [
                    "message" => "A validation error has occurred.",
                    "errors" => [
                        $validator->errors()
                    ]
                ]
            ],400);
        }
        $data["password"] = Hash::make($data["password"]);
        User::create($data);
        return response()->json(["data" => ["message" => "Success Registration"]],200);
    }
}
