<?php

namespace App\Repository;

interface WeightRepositoryInterface
{
    /**
     * Добавляет вес в БД
     *
     * @param array $data
     * @return int
     */
    
    public function viewAllWeights(int $id):array;
    public function addWeight(array $data): int;
    public function findWeightId(int $id): array;
    public function updateWeightId(int $id): array;
    public function deleteWeightId(int $id): array;
    public function lastNumberWeights(int $userId, int $numberId):array;
}
