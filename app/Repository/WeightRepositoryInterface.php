<?php
namespace App\Repository;
use \App\Weight;
 
interface WeightRepositoryInterface {
   //public function findFilmByTitle(string $title): ?Films;

    /**
     * Добавляет вес в БД
     *
     * @param array $data
     * @return array
     */
    public function addWeight(array $data): array;
}
