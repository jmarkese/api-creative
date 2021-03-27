<?php

namespace App\Observers;

use App\Models\OrderLineItem;

class OrderLineItemObserver
{
    /**
     * Handle the OrderLineItem "updated" event.
     *
     * @param  \App\Models\OrderLineItem  $orderLineItem
     * @return void
     */
    public function updated(OrderLineItem $orderLineItem)
    {
        if ($orderLineItem->flag_is_shipped == true && !$orderLineItem->order->hasUnshippedOrderLineItems()) {
            $orderLineItem->order->flag_line_items_shipped = true;
            $orderLineItem->order->save();
        }
        if ($orderLineItem->flag_is_shipped == false && $orderLineItem->order->flag_line_items_shipped) {
            $orderLineItem->order->flag_line_items_shipped = false;
            $orderLineItem->order->save();
        }
    }
}
