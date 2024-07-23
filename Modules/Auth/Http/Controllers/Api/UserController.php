<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Http\Requests\Api\User\CreateAddressRequest;
use Modules\Auth\Http\Requests\Api\User\UpdateProfileRequest;
use Modules\Auth\Http\Requests\Api\User\UpdateUserAddressRequest;
use Modules\Auth\Http\Resources\Api\User\GetProfileResource;
use Modules\Auth\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}

    public function getProfile()
    {
        $user = $this->service->getProfile();

        return response()->json(GetProfileResource::make($user));
    }

    public function CreateAddress(CreateAddressRequest $request)
    {
        $data = $this->service->createAddress($request->validated());

        return response()->json($data);
    }

    public function updateAddress(UpdateUserAddressRequest $request)
    {
        $data = $this->service->updateUserAddress($request->validated());

        return response()->json($data);
    }

    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->service->updateProfile($request->validated());

        return response()->json($user);
    }
}
