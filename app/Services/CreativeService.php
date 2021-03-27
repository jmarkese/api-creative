<?php


namespace App\Services;


use App\Models\Creative;
use App\Services\Interfaces\ICreativeService;
use App\Services\Interfaces\IProductService;

class CreativeService implements ICreativeService
{
    use ServiceTrait;

    public function __construct(private IProductService $productService)
    {
        $this->model = Creative::class;
    }

    public function getCreativesByUserId(int $userId): array
    {
        return Creative::with('products')->where('user_id', $userId)->get()->toArray();
    }

    public function getCreativeById(int $id): Creative
    {
        return Creative::with('products')->find($id);
    }

    public function getCreativeByUserIdAndId(int $id, int $userId): ?Creative
    {
        return Creative::with('products')->where('user_id', $userId)->find($id);
    }

    public function createCreative(array $data, int $userId): ?Creative
    {
        $data['user_id'] = $userId;
        $creative = Creative::create($data);
        foreach ($data['products'] as $product) {
            $product['creative_id'] = $creative->id;
            $product['user_id'] = $userId;
            $products[] = $this->productService->createProduct($product);
        }
        return Creative::with('products')->findOrFail($creative->id);
    }

    public function updateCreative(Creative $creative, array $data): ?Creative
    {
        $creative->update($data);
        return $creative;
    }

    public function updateCreativeByUserIdAndId(Creative $creative, int $userId, array $data): ?Creative
    {
        $creative->update($data);
        return $creative;
    }


}
