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
    public function Register(RegisterRequest $request) {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        User::create($data);
        return response()->json(["message" => "Registration Success"],200);
    }
}
