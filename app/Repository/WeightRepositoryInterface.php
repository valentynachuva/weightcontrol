<?php
namespace App\Repository;
use \App\Weight;
 
interface WeightRepositoryInterface {
  public function findById(int $id): ?Weight;

    /**
     * Добавляет вес в БД
     *
     * @param array $data
     * @return array
     */
    public function addWeight(array $data): array;
}
