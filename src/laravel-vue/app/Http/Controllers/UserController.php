<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\containsOnly;

class UserController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function Register(RegisterRequest $request) {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        User::create($data);
        return response()->json(["message" => "Registration Success."],200);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function Login(LoginRequest $request) {
        if(Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $this->SetTokenExpiresAt($token);
            return response()->json([
                "data" => [ "token" => $token ]
            ],200);
        }
        else {
            return response()->json(["message" => "Login Unsuccessful."],401);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function IsLoginValid(Request $request) {
        return response()->json(["message" => "Authenticated."],200);
    }

    /**
     * @param $token
     * @return void
     */
    private function SetTokenExpiresAt($token) {
        $explode = explode('|',$token);
        $thisToken = count($explode) == 2 ? $explode[1] : $token;
        $tokenHash = \hash('sha256',$thisToken);
        $data = PersonalAccessToken::all()->where('token',$tokenHash)->first();
        $data->expires_at = Carbon::now()->addDay();
        $data->save();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function KeepTokenAlive(Request $request) {
        $this->SetTokenExpiresAt($request->bearerToken());
        return response()->json(["message" => "Token Kept Alive."],200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function Logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message" => "Logout Success."],200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function LogoutAll(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Logout All Success."],200);
    }
}
