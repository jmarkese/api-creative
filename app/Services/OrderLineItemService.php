<?php


namespace App\Services;


use App\Models\OrderLineItem;
use App\Services\Interfaces\IOrderLineItemService;

class OrderLineItemService implements IOrderLineItemService
{

    public function createOrderLineItemByOrderId(array $data): ?OrderLineItem
    {
        return OrderLineItem::create($data);
    }

    public function updateOrderLineItem(int $id, array $data): ?OrderLineItem
    {
        $orderLineItem = OrderLineItem::findOrFail($id);
        foreach ($data as $k => $v) $orderLineItem->$k = $v;
        $orderLineItem->save();
        return $orderLineItem->fresh();
    }

}
