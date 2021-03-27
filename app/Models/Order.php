<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id',
        'flag_line_items_shipped',
        'updated_at',
        'created_at',
    ];

    protected $with = ['orderLineItems'];

    public function orderLineItems()
    {
        return $this->hasMany(OrderLineItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasUnshippedOrderLineItems()
    {
        return $this->orderLineItems()->where('flag_is_shipped', false)->exists();
    }

}
