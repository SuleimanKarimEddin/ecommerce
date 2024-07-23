<?php

namespace Modules\Auth\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\Dashboard\Admin\LoginRequest;
use Modules\Auth\Services\AuthService;

class AdminAuthController extends Controller
{
    public function __construct(private AuthService $service) {}

    public function login(LoginRequest $request)
    {

        $data = $this->service->loginAdmin($request->email, $request->password);

        return response()->json($data);
    }

    public function logout(Request $request)
    {

        $data = $this->service->logout($request->user());
        response()->json($data);
    }
}
