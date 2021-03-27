<?php


namespace App\Services\Interfaces;


use App\Models\OrderLineItem;

interface IOrderLineItemService extends IService
{

    public function createOrderLineItemByOrderId(array $data): ?OrderLineItem;
    public function updateOrderLineItem(int $id, array $data): ?OrderLineItem;
}
