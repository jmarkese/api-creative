<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'postal_code',
    ];

    public function productTypeVendor()
    {
        return $this->belongsTo(ProductTypeVendor::class);
    }

}
