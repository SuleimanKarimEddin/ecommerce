<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\Review\CreateReviewRequest;
use Modules\Product\Http\Requests\Review\DeleteReviewRequest;
use Modules\Product\Http\Requests\Review\GetAllReviewRequest;
use Modules\Product\Http\Requests\Review\UpdateReviewRequest;
use Modules\Product\Http\Resources\Review\GetAllReviewResource;
use Modules\Product\Services\ReviewService;

class ReviewController extends Controller
{
    public function __construct(private ReviewService $service) {}

    public function getAll(GetAllReviewRequest $request)
    {
        $data = $this->service->getAll($is_pagenate = true, $request->per_page ?? 8);
        $response = GetAllReviewResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateReviewRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateReviewRequest $request)
    {
        $data = $this->service->update($request->id, $request->validated());

        return response()->json($data);
    }

    public function delete(DeleteReviewRequest $request)
    {
        $data = $this->service->delete($request->id);

        return response()->json($data);
    }
}
