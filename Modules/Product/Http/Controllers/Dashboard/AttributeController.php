<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\Attribute\CreateAttributeRequest;
use Modules\Product\Http\Requests\Attribute\UpdateAttributeRequest;
use Modules\Product\Http\Resources\Attribute\GetAllAttributeResource;
use Modules\Product\Services\AttributeService;

class AttributeController extends Controller
{
    public function __construct(private AttributeService $service) {}

    public function getAll()
    {
        $data = $this->service->getAll($is_paginate = true);
        $response = GetAllAttributeResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateAttributeRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        $data = $this->service->updateAttribute($id, $request->validated());

        return response()->json($data);
    }

    public function delete($id)
    {
        $data = $this->service->deleteAttribute($id);

        return response()->json($data);
    }
}
