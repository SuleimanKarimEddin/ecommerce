<?php

namespace Modules\Payment\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Base\Exceptions\CustomException;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Models\Orders;
use Modules\Payment\Http\Requests\Api\Payment\CheckoutRequest;
use Modules\Payment\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $service) {}

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->validated();
        $method = $data['payment_method'];
        foreach ($data['items'] as $item) {
            $this->checkTheQuantityOfTheProduct($item['id'], $item['quantity']);
        }
        $user = auth()->user();
        $order = $this->service->createInitPaymentOrder($user->id, $data['address_id'], PaymentMethodEnum::from($method), 0);
        $results = $this->service->constractLineItemsAndFindTotal($data);
        $lineItems = $results['lineItems'];
        $total = $results['total'];
        $session = 0;
        if ($method == 'online') {
            $session = $this->service->paidByStrip($lineItems);
        }

        $order->update([
            'payment_id' => $session->id,
            'order_status' => OrderStatusEnum::Pending->value,
            'total' => $total,
        ]);

        return $session->url;
    }

    public function success(Request $request)
    {
        $payment_id = $request['session_id'];
        if (! $payment_id) {
            throw new CustomException('Payment id not found', 404);
        }
        $order = Orders::where('payment_id', $payment_id)->first();
        if (! $order) {
            throw new CustomException('Order not found', 404);
        }
        if ($order->order_status != OrderStatusEnum::Completed->value) {
            $order->update([
                'order_status' => OrderStatusEnum::Completed->value,
            ]);
        }

        return redirect('https://google.com');
    }

    public function cancel(Request $request)
    {
        $payment_id = $request['session_id'];
        $order = Orders::where('payment_id', $payment_id)->first();
        $order->update([
            'order_status' => OrderStatusEnum::Canceled->value,
        ]);

        return redirect('https://youtube.com');
    }

    private function checkTheQuantityOfTheProduct(int $variant_id, int $quantity) {}
}
