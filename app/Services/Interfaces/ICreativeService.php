<?php


namespace App\Services\Interfaces;


use App\Models\Creative;

interface ICreativeService extends IService
{
    /**
     * @param int $userId
     * @return Creative[]
     */
    public function getCreativesByUserId(int $userId): array;

    /**
     * @param int $id
     * @return Creative
     */
    public function getCreativeById(int $id): ?Creative;

    /**
     * @param int $id
     * @param int $userId
     * @return Creative
     */
    public function getCreativeByUserIdAndId(int $id, int $userId): ?Creative;

    /**
     * @param array $data
     * @return Creative
     */
    public function createCreative(array $data, int $userId): ?Creative;

    /**
     * @param Creative $creative
     * @param array $data
     * @return Creative
     */
    public function updateCreative(Creative $creative, array $data): ?Creative;

    public function updateCreativeByUserIdAndId(Creative $creative, int $userId, array $data): ?Creative;
}
