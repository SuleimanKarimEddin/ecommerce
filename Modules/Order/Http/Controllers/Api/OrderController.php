<?php

namespace Modules\Order\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Order\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(protected OrderService $service) {}

    public function getOne($id)
    {
        $data = $this->service->getOne($id);

        return response()->json($data);
    }

    public function getAll()
    {

        $data = $this->service->getAllOrderForUser();

        return response()->json($data);
    }
}
