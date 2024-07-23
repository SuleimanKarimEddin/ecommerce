<?php

namespace Modules\Auth\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Auth\Http\Requests\Dashboard\Admin\CreateAdminRequest;
use Modules\Auth\Http\Requests\Dashboard\Admin\DeleteAdminRequest;
use Modules\Auth\Http\Requests\Dashboard\Admin\GetOneAdminRequest;
use Modules\Auth\Http\Requests\Dashboard\Admin\UpdateAdminRequest;
use Modules\Auth\Http\Resources\Dashboard\Admin\GetAllAdminResource;
use Modules\Auth\Http\Resources\Dashboard\Admin\GetOneAdminResource;
use Modules\Auth\Services\AdminService;

class AdminController extends Controller
{
    public function __construct(private AdminService $service) {}

    public function getAll()
    {
        $data = $this->service->getAll();
        $response = GetAllAdminResource::collection($data);

        return response()->json($response);
    }

    public function getOne(GetOneAdminRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneAdminResource($data);

        return response()->json($response);
    }

    public function create(CreateAdminRequest $request)
    {
        $data = $this->service->createAdmin($request->validated());

        return response()->json($data);
    }

    public function update(UpdateAdminRequest $request)
    {
        $data = $this->service->update($request->id, $request->validated());

        return response()->json($data);
    }

    public function delete(DeleteAdminRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
