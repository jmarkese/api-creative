<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Product extends Pivot
{
    protected $table = 'products';
    protected $with = ['creative', 'productType.productTypeVendor'];

    protected $fillable = [
        'custom_name',
        'custom_description',
        'sku',
        'price',
        'creative_id',
        'product_type_id',
    ];

    public function creative()
    {
        return $this->hasOne(Creative::class, 'id', 'creative_id');
    }

    public function productType()
    {
        return $this->hasOne(ProductType::class, 'id', 'product_type_id');
    }

    public function orderLineItems()
    {
        return $this->hasMany(OrderLineItem::class);
    }


}
