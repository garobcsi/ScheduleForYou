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
     * Register an account
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function Register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);
        User::create($data);
        return response()->json(["message" => "Registration Success."],200);
    }

    /**
     * Login with user account
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function Login(LoginRequest $request): JsonResponse
    {
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
     * Check if token valid
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function IsLoginValid(Request $request): JsonResponse
    {
        return response()->json(["message" => "Authenticated."],200);
    }

    /**
     * Set The Token Expiry Date
     *
     * @param $token
     * @return void
     */
    private function SetTokenExpiresAt($token): void
    {
        $explode = explode('|',$token);
        $thisToken = count($explode) == 2 ? $explode[1] : $token;
        $tokenHash = \hash('sha256',$thisToken);
        $data = PersonalAccessToken::all()->where('token',$tokenHash)->first();
        $data->expires_at = Carbon::now()->addDay();
        $data->save();
    }

    /**
     * Set The Token Expiry Date with api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function KeepTokenAlive(Request $request): JsonResponse
    {
        $this->SetTokenExpiresAt($request->bearerToken());
        return response()->json(["message" => "Token Kept Alive."],200);
    }

    /**
     * Logout of user account
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function Logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message" => "Logout Success."],200);
    }

    /**
     * Logout of all user devices
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function LogoutAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Logout All Success."],200);
    }
}
