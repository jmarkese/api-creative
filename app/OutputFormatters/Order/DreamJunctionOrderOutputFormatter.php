<?php


namespace App\OutputFormatters\Order;


use App\OutputFormatters\IOutputFormatter;
use App\Services\VendorService;
use SimpleXMLElement;

class DreamJunctionOrderOutputFormatter implements IOutputFormatter
{
    /**
     * DreamJunctionOrderOutputFormatter constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $data
     * @return string
     */
    public function output($data): string
    {
        $mapped = $this->mapData($data);
        return (string) $this->arrayToXml($mapped, new SimpleXMLElement("<orders/>"));
    }

    private function arrayToXml($data, SimpleXMLElement $xml)
    {
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                if (is_numeric($k)) {
                    $this->arrayToXml($v, $xml);
                } else {
                    $this->arrayToXml($v, $xml->addChild($k));
                }
            } else {
                $xml->addChild($k, $v);
            }
        }
        return $xml->asXML();
    }

    /**
     * @param array $orders
     */
    private function mapData($orders): array
    {
        return array_map(function ($order) {
            return $this->mapOrder($order);
        }, $orders);
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
            'order' => [
                'order_number' => $order['id'],
                'customer_data' => [
                    'first_name' => $order['ship_to_first_name'],
                    'last_name' => $order['ship_to_last_name'],
                    'address1' => $order['ship_to_address_1'],
                    'address2' => $order['ship_to_address_2'],
                    'city' => $order['ship_to_city'],
                    'state' => $order['ship_to_state'],
                    'zip' => $order['ship_to_postal_code'],
                    'country' => $order['ship_to_country'],
                ],
                'items' => $orderLineItems,
            ]
        ];
    }

    /**
     * @param array $orderLineItem
     */
    private function mapOrderLineItem($orderLineItem): array
    {
        return [
            'item' => [
                'order_line_item_id' => $orderLineItem['id'],
                'product_id' => $orderLineItem['product']['id'],
                'quantity' => $orderLineItem['qty'],
                'image_url' => $orderLineItem['product']['creative']['image_url'],
                'debug_info' => $orderLineItem['product']['slug'],
            ]
        ];
    }

    public function contentType(): string
    {
        return "application/xml";
    }

}
