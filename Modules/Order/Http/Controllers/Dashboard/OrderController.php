<?php

namespace Modules\Order\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Order\Http\Resources\Order\GetAllOrderCollection;
use Modules\Order\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function getOne(Request $request, $id)
    {
        $order = $this->service->getOne($id);

        return response()->json($order);
    }

    public function getAll(Request $request)
    {
        $order = $this->service->getAll();
        $response = new GetAllOrderCollection($order);

        return response()->json($response);
    }

    public function changeStatus(int $id, string $status)
    {

        $order = $this->service->changeStatus($id, $status);

        return response()->json($order);
    }
}
