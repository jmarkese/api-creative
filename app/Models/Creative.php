<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    protected $guarded = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class)->using(Product::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
