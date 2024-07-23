<?php

namespace Modules\Order\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Exceptions\CustomException;
use Modules\Base\Exceptions\NotFoundException;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Models\OrderItems;
use Modules\Order\Models\Orders;

class OrderService
{
    public function getAll(): LengthAwarePaginator
    {
        return Orders::with(['address'])->paginate(10);
    }

    public function getOne(int $id): Model
    {
        $order = Orders::with(['orderItems', 'orderItems.productVariation', 'orderItems.productVariation.product', 'address', 'user'])->find($id);
        if (! $order) {
            throw new NotFoundException();
        }

        return $order;

    }

    public function changeStatus(int $id, string $status)
    {

        if (! in_array($status, array_column(OrderStatusEnum::cases(), 'value'))) {

            throw new CustomException('Invalid status', 500);
        }
        $isUpdated = Orders::where('id', $id)->update(['order_status' => $status]);

        if ($isUpdated) {
            return true;
        }

        throw new NotFoundException();
    }

    public function getAllOrderForUser(): Collection
    {

        return Orders::with('orderItems')->where('user_id', auth()->user()->id)->get();
    }

    public function createOrder(int $user_id, int $address_id, OrderStatusEnum $orderStatus, PaymentMethodEnum $paymentMethod, int $total): Orders
    {
        $order = Orders::create([
            'user_id' => $user_id,
            'address_id' => $address_id,
            'order_status' => $orderStatus->value,
            'payment_method' => $paymentMethod->value,
            'total' => $total,
        ]);

        return $order;
    }

    public function createOrderItems(int $orderItems_id, int $quantity, int $variation_id, int $price): void
    {
        OrderItems::create([
            'order_id' => $orderItems_id,
            'variation_id' => $variation_id,
            'quantity' => $quantity,
            'price' => $price,
        ]);
    }
}
