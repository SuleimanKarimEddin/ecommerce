<?php

namespace Modules\Payment\Services;

use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Models\Orders;
use Modules\Order\Services\OrderService;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentService
{
    public function __construct(private OrderService $orderService) {}

    public function paidByStrip(array $lineItems)
    {
        Stripe::setApiKey(config('payment.stripe_secret'));

        return Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('api.payment.success', [], true).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('api.payment.cancel', [], true).'?session_id={CHECKOUT_SESSION_ID}',
        ]);

    }

    public function constractLineItemsAndFindTotal(array $data)
    {
        $total = 0;
        foreach ($data['items'] as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
            $total += $item['price'] * $item['quantity'];
        }

        return ['lineItems' => $lineItems, 'total' => $total];

    }

    public function createItemsOrders(array $data)
    {
        foreach ($data['items'] as $item) {
            $this->orderService->createOrderItems($item['id'], $item['quantity'], $item['id'], $item['price']);
        }
    }

    public function createInitPaymentOrder(int $user_id, int $address_id, PaymentMethodEnum $paymentMethod, int $total): Orders
    {
        return $this->orderService->createOrder($user_id, $address_id, OrderStatusEnum::Pending, $paymentMethod, $total);
    }
}
