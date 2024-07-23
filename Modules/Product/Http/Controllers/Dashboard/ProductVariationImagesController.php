<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\Dashboard\ProductVariationImages\CreateProductVariationImagesRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariationImages\DeleteProductVariationImagesRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariationImages\GetAllProductVariationImagesRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariationImages\GetOneProductVariationImagesRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariationImages\UpdateProductVariationImagesRequest;
use Modules\Product\Http\Resources\Dashboard\ProductVariationImages\GetAllProductVariationImagesResource;
use Modules\Product\Http\Resources\Dashboard\ProductVariationImages\GetOneProductVariationImagesResource;

class ProductVariationImagesController extends Controller
{
    public function __construct(private $service) {}

    public function getOne(GetOneProductVariationImagesRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneProductVariationImagesResource($data);

        return response()->json($response);
    }

    public function getAll(GetAllProductVariationImagesRequest $request)
    {
        $data = $this->service->getAll($is_pagenate = true, $request->per_page ?? 8);
        $response = GetAllProductVariationImagesResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateProductVariationImagesRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateProductVariationImagesRequest $request)
    {
        $data = $this->service->update($request->id, $request->validated());

        return response()->json($data);
    }

    public function delete(DeleteProductVariationImagesRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
