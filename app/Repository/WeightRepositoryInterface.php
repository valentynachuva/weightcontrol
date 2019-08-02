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
    public function addWeight(array $data): int;
    public function findWeightId(int $id):array;
}
