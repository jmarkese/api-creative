<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Vendor;
use App\Services\Interfaces\IOrderLineItemService;
use App\Services\Interfaces\IOrderService;

class OrderService implements IOrderService
{

    public function __construct(private IOrderLineItemService $orderLineItemService)
    {
    }

    public function getVendorOpenOrdersByVendorSlug(string $vendorSlug): array
    {
        $vendorId = Vendor::where('slug', $vendorSlug)->firstOrfail()->id;
        $orders = Order::with([
                'orderLineItems' => function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId)
                        ->where('flag_is_shipped', false);
                },
                'orderLineItems.product',
            ])
            ->whereHas('orderLineItems', function($query) use ($vendorId){
                $query->where('vendor_id', $vendorId)
                    ->where('flag_is_shipped', false);
            })
            ->get();
        return $orders->toArray();
    }

    public function updateVendorOrderById(int $id, array $data): ?Order
    {
        $order = Order::find($id);
        foreach ($data['order_line_items'] as $order_line_item) {
            $id = $order_line_item['id'];
            unset($order_line_item['id']);
            $this->orderLineItemService->updateOrderLineItem($id, $order_line_item);
        }
        $ret =  $order->fresh();
        return $ret;
    }

    public function createOrderByUserId(array $data, int $userId): ?Order
    {
        $data['user_id'] = $userId;
        $order = Order::create($data);
        foreach ($data['order_line_items'] as $order_line_item) {
            $order_line_item['order_id'] = $order->id;
            $this->orderLineItemService->createOrderLineItemByOrderId($order_line_item);
        }
        return $order->fresh();
    }
}
