<?php

namespace App\Repository;

interface WeightRepositoryInterface
{
   
    public function viewAllWeights(int $userId): \Illuminate\Database\Eloquent\Collection;

    public function addWeight(array $data): int;

    public function findWeightId(int $id, int $userId): \Illuminate\Database\Eloquent\Collection;

    public function updateWeightId(int $id): ?\App\Weight; //? - возвращает значение либо null, либо результат

    public function deleteWeightId(int $id);

    public function lastNumberWeights(int $userId, int $numberId): \Illuminate\Database\Eloquent\Collection;

    public function weightsBetweenDates(int $userId, array $data): \Illuminate\Database\Eloquent\Collection;
}
