<?php


namespace App\Services;


use App\Models\Creative;
use App\Models\ProductType;
use App\Services\Interfaces\ICreativeService;

class CreativeService implements ICreativeService
{
    use ServiceTrait;

    public function __construct()
    {
        $this->model = Creative::class;
    }

    public function getCreativesByUserId(int $userId): array
    {
        return Creative::where('user_id', $userId)->get()->toArray();
    }

    public function getCreativeById(int $id): Creative
    {
        return Creative::find($id);
    }

    public function getCreativeByUserIdAndId(int $id, int $userId): ?Creative
    {
        return Creative::where('user_id', $userId)->find($id);
    }

    public function createCreative(array $data, int $userId): ?Creative
    {
        $data['user_id'] = $userId;
        $creative = Creative::create($data);
        // TODO modify productTypes
//        foreach ($data['product_types'] as $productType) {
//            $productType = ProductType::whereIn('slug', $productType);
//
//        }
        return $creative;
    }

    public function updateCreative(Creative $creative, array $data): ?Creative
    {
        $creative->update($data);

        // TODO modify productTypes

        return $creative;
    }

    public function updateCreativeByUserIdAndId(Creative $creative, int $userId, array $data): ?Creative
    {
        $creative->update($data);

        // TODO modify productTypes

        return $creative;
    }


}
