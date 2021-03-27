<?php


namespace App\Services\Interfaces;


use App\Models\Product;

interface IProductService extends IService
{
    public function createProduct(array $data): ?Product;
}
