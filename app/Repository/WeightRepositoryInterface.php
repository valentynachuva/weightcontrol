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
    
   // public function viewAllWeights(): \App\Weight;
    public function addWeight(array $data): int;
    public function findWeightId(int $id): \App\Weight;
    public function updateWeightId(int $id): \App\Weight;
    public function deleteWeightId(int $id): \App\Weight;
}
