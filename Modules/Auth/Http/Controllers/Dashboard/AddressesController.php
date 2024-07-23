<?php

namespace Modules\Auth\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\Dashboard\Addresses\CreateAddressesRequest;
use Modules\Auth\Http\Requests\Dashboard\Addresses\DeleteAddressesRequest;
use Modules\Auth\Http\Requests\Dashboard\Addresses\GetOneAddressesRequest;
use Modules\Auth\Http\Requests\Dashboard\Addresses\UpdateAddressesRequest;
use Modules\Auth\Http\Requests\Dashboard\Addresses\GetAllAddressesRequest;

use Modules\Auth\Http\Resources\Dashboard\Addresses\GetAllAddressesResource;
use Modules\Auth\Http\Resources\Dashboard\Addresses\GetOneAddressesResource;
use Modules\Auth\Services\AddressesServices;

class AddressesController extends Controller
{
    public function __construct(private AddressesServices $service) {

    }

    public function getOne(GetOneAddressesRequest $request) {
        $data = $this->service->findByID($request->id);
        $response = new GetOneAddressesResource($data);
        return response()->json($response);
    }

    public function getAll(GetAllAddressesRequest $request) {
        $data = $this->service->getAllAddresses($request->validated());
        $response = GetAllAddressesResource::collection($data);
        return response()->json($response);
    }

    public function create(CreateAddressesRequest $request) {
        $data = $this->service->createAddress($request->validated());
        return response()->json($data);
    }

    public function update(UpdateAddressesRequest $request) {
        $data = $this->service->updateAddress($request->id, $request->validated());
        return response()->json($data);
    }

    public function delete(DeleteAddressesRequest $request) {
        $data = $this->service->delete($request->id);
        return response()->json($data);
    }
}