<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\Dashboard\Product\CreateProductRequest;
use Modules\Product\Http\Requests\Dashboard\Product\DeleteProductRequest;
use Modules\Product\Http\Requests\Dashboard\Product\GetAllProductRequest;
use Modules\Product\Http\Requests\Dashboard\Product\GetOneProductRequest;
use Modules\Product\Http\Requests\Dashboard\Product\UpdateProductRequest;
use Modules\Product\Http\Resources\Dashboard\Product\GetAllProductResource;
use Modules\Product\Http\Resources\Dashboard\Product\GetOneProductResource;
use Modules\Product\Services\Dashboard\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function show(GetOneProductRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneProductResource($data);

        return response()->json($response);
    }

    public function index(GetAllProductRequest $request)
    {

        $data = $this->service->getAll($is_pagenate = true, $request->per_page ?? 8);
        $response = GetAllProductResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateProductRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateProductRequest $request)
    {
        $data = $this->service->update($request->id, $request->validated());

        return response()->json($data);
    }

    public function delete(DeleteProductRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
