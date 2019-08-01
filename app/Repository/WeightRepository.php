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
  
   
  //   private function toDbArray(array $apiResponse): array
  //  {
   ///     return [
     //       'value' => $apiResponse['Value'],
   //         'remark' => $apiResponse['Remark'],
      //      'user_id' => Auth::user()->id
     //   ];
   // }
}
