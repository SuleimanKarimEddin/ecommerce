<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\AttributeValues\CreateAttributeValuesRequest;
use Modules\Product\Http\Requests\AttributeValues\UpdateAttributeValuesRequest;
use Modules\Product\Http\Resources\AttributeValues\GetAllAttributeValuesResource;
use Modules\Product\Services\AttributeValueService;

class AttributeValuesController extends Controller
{
    public function __construct(private AttributeValueService $service) {}

    public function getAll()
    {
        $data = $this->service->getAll();
        $response = GetAllAttributeValuesResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateAttributeValuesRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateAttributeValuesRequest $request, $id)
    {
        $data = $this->service->updateAttributeValue($id, $request->validated());

        return response()->json($data);
    }

    public function delete($id)
    {
        $data = $this->service->deleteAttributeValue($id);

        return response()->json($data);
    }
}
