<?php


namespace App\Services\Interfaces;


use App\Models\Creative;
use App\Models\Order;

interface IOrderService extends IService
{
    /**
     * @param string $vendorSlug
     * @return Order[]
     */
    public function getVendorOpenOrdersByVendorSlug(string $vendorSlug): array;

    /**
     * @param int $id
     * @param array $data
     * @return Order|null
     */
    public function updateVendorOrderById(int $id, array $data): ?Order;

    /**
     * @param array $data
     * @param int $userId
     * @return Order[]
     */
    public function createOrderByUserId(array $data, int $userId): ?Order;

}
