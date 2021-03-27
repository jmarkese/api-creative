<?php


namespace App\OutputFormatters\Order;


use App\OutputFormatters\IOutputFormatter;

class MarcoFineArtsOrderOutputFormatter implements IOutputFormatter
{

    /**
     * MarcoFineArtsOrderOutputFormatter constructor.
     */
    public function __construct()
    {
    }

    public function output($data): string
    {
        $mapped = $this->mapData($data);
        return json_encode($mapped);
    }

    /**
     * @param array $orders
     */
    private function mapData($orders): array
    {
        return [
            'data' => [
                'orders' => array_map(function ($order) {
                    return $this->mapOrder($order);
                }, $orders)
            ]
        ];
    }

    /**
     * @param array $order
     */
    private function mapOrder($order): array
    {
        $orderLineItems = collect($order['order_line_items'])
            ->map(function ($item, $key) {
                return $this->mapOrderLineItem($item);
            })
            ->all();

        return [
                'external_order_id' => $order['id'],
                'buyer_first_name' => $order['ship_to_first_name'],
                'buyer_last_name' => $order['ship_to_last_name'],
                'buyer_shipping_address_1' => $order['ship_to_address_1'],
                'buyer_shipping_address_2' => $order['ship_to_address_2'],
                'buyer_shipping_city' => $order['ship_to_city'],
                'buyer_shipping_state' => $order['ship_to_state'],
                'buyer_shipping_postal' => $order['ship_to_postal_code'],
                'buyer_shipping_country' => $order['ship_to_country'],
                'print_line_items' => $orderLineItems,
        ];
    }

    /**
     * @param array $orderLineItem
     */
    private function mapOrderLineItem($orderLineItem): array
    {
        return [
            'external_order_line_item_id' => $orderLineItem['id'],
            'product_id' => $orderLineItem['product']['id'],
            'quantity' => $orderLineItem['qty'],
            'image_url' => $orderLineItem['product']['creative']['image_url'],
            'debug_info' => $orderLineItem['product']['slug'],
        ];
    }


    public function contentType(): string
    {
        return "application/json";
    }
}
