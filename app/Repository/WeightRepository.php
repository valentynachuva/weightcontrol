<?php
namespace App\Repository;
use \App\Weight;
use Illuminate\Foundation\Testing\RefreshDatabase;



class WeightRepository implements WeightRepositoryInterface {
    
   use RefreshDatabase;
    /**
     * @var Weight

     */
    private $model;

    public function __construct()
    {
        $this->model = app(Weight::class);
    }
    public function addWeight(array $data): array
    {
        $data = $this->toDbArray($data);
        $this->model->create($data);
        return $data;
    }
    
     private function toDbArray(array $apiResponse): array
    {
        return [
            'value' => $apiResponse['Value'],
            'remark' => $apiResponse['Remark']
        ];
    }
}
