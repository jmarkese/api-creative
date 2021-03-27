<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function creatives()
    {
        return $this->belongsToMany(Creative::class)->using(Product::class);
    }

    public function productTypeVendor()
    {
        return $this->belongsTo(ProductTypeVendor::class);
    }


}
