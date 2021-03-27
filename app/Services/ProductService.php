<?php


namespace App\Services;


use App\Models\Product;
use App\Services\Interfaces\IProductService;

class ProductService implements IProductService
{

    public function createProduct(array $data): ?Product
    {
        return Product::create($data);
    }
}
