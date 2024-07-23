<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\Api\Auth\LoginUserRequest;
use Modules\Auth\Http\Requests\Api\Auth\RegisterUserRequest;
use Modules\Auth\Http\Requests\Api\Auth\VerifyCodeRequest;
use Modules\Auth\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $service) {}

    public function login(LoginUserRequest $request)
    {
        $data = $this->service->loginUser($request->phone_number, $request->password);

        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $data = $this->service->logout($request->user());

        return response()->json($data);
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $this->service->registerUser($request->validated());

        return response()->json($data);
    }

    public function verify(VerifyCodeRequest $request)
    {
        $data = $this->service->verifyUser($request->phone_number, $request->code);

        return response()->json($data);
    }

    public function reSendCode(VerifyCodeRequest $request)
    {

        $data = $this->service->resendCode($request->phone_number);

        return response()->json($data);

    }
}
