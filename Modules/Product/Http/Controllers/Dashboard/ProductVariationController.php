<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\Dashboard\ProductVariation\CreateProductVariationRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariation\DeleteProductVariationRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariation\GetAllProductVariationRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariation\GetOneProductVariationRequest;
use Modules\Product\Http\Requests\Dashboard\ProductVariation\UpdateProductVariationRequest;
use Modules\Product\Http\Resources\Dashboard\ProductVariation\GetAllProductVariationResource;
use Modules\Product\Http\Resources\Dashboard\ProductVariation\GetOneProductVariationResource;
use Modules\Product\Services\Dashboard\ProductVariationService;

class ProductVariationController extends Controller
{
    public function __construct(private ProductVariationService $service) {}

    public function show(GetOneProductVariationRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneProductVariationResource($data);

        return response()->json($response);
    }

    public function index(GetAllProductVariationRequest $request)
    {
        $data = $this->service->index($is_pagenate = true, $request->per_page ?? 8);
        $response = GetAllProductVariationResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateProductVariationRequest $request)
    {
            
        $data = $this->service->createWithImages($request->validated());

        return response()->json($data);
    }

    public function update(UpdateProductVariationRequest $request)
    {
    
        $data = $this->service->updateWithImage($request->id, $request->validated());
        return response()->json($data);
    }

    public function delete(DeleteProductVariationRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
