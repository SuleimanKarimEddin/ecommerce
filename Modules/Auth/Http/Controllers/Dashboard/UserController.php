<?php

namespace Modules\Auth\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Auth\Http\Requests\Dashboard\User\CreateUserRequest;
use Modules\Auth\Http\Requests\Dashboard\User\DeleteUserRequest;
use Modules\Auth\Http\Requests\Dashboard\User\GetOneUserRequest;
use Modules\Auth\Http\Requests\Dashboard\User\UpdateUserRequest;
use Modules\Auth\Http\Resources\Dashboard\User\GetAllUserResource;
use Modules\Auth\Http\Resources\Dashboard\User\GetOneUserResource;
use Modules\Auth\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}

    public function getOne(GetOneUserRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneUserResource($data);

        return response()->json($response);
    }

    public function getAll()
    {
        $data = $this->service->getAll($is_pagenate = true, 8);
        $response = GetAllUserResource::collection($data);

        return response()->json($response);
    }
    public function create(CreateUserRequest $request)
    {
        $data = $this->service->createUser($request->validated());

        return response()->json($data);
    }

    public function update(UpdateUserRequest $request)
    {
        $data = $this->service->updateUser($request->id, $request->validated());
        return response()->json($data);
    }

    public function delete(DeleteUserRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
