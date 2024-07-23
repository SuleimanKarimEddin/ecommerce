<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\Dashboard\Category\CreateCategoryRequest;
use Modules\Product\Http\Requests\Dashboard\Category\DeleteCategoryRequest;
use Modules\Product\Http\Requests\Dashboard\Category\GetAllCategoryRequest;
use Modules\Product\Http\Requests\Dashboard\Category\GetOneCategoryRequest;
use Modules\Product\Http\Requests\Dashboard\Category\UpdateCategoryRequest;
use Modules\Product\Http\Resources\Dashboard\Category\GetAllCategoryCollection;
use Modules\Product\Http\Resources\Dashboard\Category\GetOneCategoryResource;
use Modules\Product\Services\Dashboard\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function show(GetOneCategoryRequest $request)
    {
        $data = $this->service->findByID($request->id);
        $response = new GetOneCategoryResource($data);

        return response()->json($response);
    }

    public function index(GetAllCategoryRequest $request)
    {
        $data = $this->service->getAll($is_pagenate = true, $request->per_page ?? 8);
        $response = new GetAllCategoryCollection($data);

        return response()->json($response);
    }

    public function create(CreateCategoryRequest $request)
    {
        $data = $this->service->createWithImage($request->validated());

        return response()->json($data);
    }

    public function update(UpdateCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        $id = $request->id;
        $this->service->updateWithImage($id, $validatedRequest);

        return response()->json(['message' => 'updated_succusfuly']);
    }

    public function delete(DeleteCategoryRequest $request)
    {

        $this->service->delete($request->id);

        return response()->json(['message' => 'deleted_succusfuly']);
    }
}
