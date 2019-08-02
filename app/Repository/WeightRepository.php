<?php
namespace App\Repository;

use \App\Weight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;



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
     //   $data = $this->toDbArray($data);
      //  dd($data);
      //  $this->model->create($data);
        
          $weight= \App\Weight::create([

   $data= 'value' => request('value'),
  $data=  'remark' => request('remark'),
  $data= 'user_id' => Auth::user()->id
]);
  $array = json_decode(json_encode($weight), True);
        return $array;
    }
public function findById(int $id): ?Weight
    {
     $data = $this->model->where('id'=> request('id'))->first();
        return $data;
}
   
}
