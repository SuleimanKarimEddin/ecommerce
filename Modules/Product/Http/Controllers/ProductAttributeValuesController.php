<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\ProductAttributeValues\CreateProductAttributeValuesRequest;
use Modules\Product\Http\Requests\ProductAttributeValues\DeleteProductAttributeValuesRequest;
use Modules\Product\Http\Requests\ProductAttributeValues\GetAllProductAttributeValuesRequest;
use Modules\Product\Http\Requests\ProductAttributeValues\GetOneProductAttributeValuesRequest;
use Modules\Product\Http\Requests\ProductAttributeValues\UpdateProductAttributeValuesRequest;
use Modules\Product\Http\Resources\ProductAttributeValues\GetAllProductAttributeValuesResource;
use Modules\Product\Http\Resources\ProductAttributeValues\GetOneProductAttributeValuesResource;
use Modules\Product\Services\ProductAttributeValueService;

class ProductAttributeValuesController extends Controller
{
    public function __construct(private ProductAttributeValueService $service) {}

    public function getOne(GetOneProductAttributeValuesRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneProductAttributeValuesResource($data);

        return response()->json($response);
    }

    public function getAll(GetAllProductAttributeValuesRequest $request)
    {
        $data = $this->service->getAll($is_pagenate = true, $request->per_page ?? 8);
        $response = GetAllProductAttributeValuesResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateProductAttributeValuesRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateProductAttributeValuesRequest $request)
    {
        $data = $this->service->update($request->id, $request->validated());

        return response()->json($data);
    }

    public function delete(DeleteProductAttributeValuesRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
