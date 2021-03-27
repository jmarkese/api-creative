<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeVendor extends Model
{
    protected $fillable = [
        'vendor_id',
        'vendor_product_id',
        'product_type_id',
    ];
}
