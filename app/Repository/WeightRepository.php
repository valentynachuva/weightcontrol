<?php
namespace App\Repository;

use \App\Weight;
use \App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeightRepository implements WeightRepositoryInterface
{
    //TODO  Это здесь не нужно, ибо при каждом вызове будет чиститься БД
    //use RefreshDatabase;

    /**
     * @var Weight

     */
    private $model;

    public function __construct()
    {
        $this->model = app(Weight::class);
    }

    /**
     * TODO Логика работы в корне не верна в это месте
     * TODO пускай возвращает тип int (ID вставленной записи
     *
     * @param array $data
     * @return int
     */
    public function addWeight(array $data): int
    {
        //TODO Просто сохраняй данные здесь и все

        // TODO поскольку у тебя уже есть модель, фасад для создания записи можешь не использовать
        $this->model->fill($data)->save();
        return $this->model->id;
    }
    public function findWeightId(int $id): array
        
    {
    $weightId = Weight::findOrFail($id)->id;
  
      $users = DB::table('users')
        ->join('weights', 'users.id', '=', 'weights.user_id')
           ->select('users.name', 'users.email','weights.id as weightId', 'users.created_at', 'users.updated_at', 'weights.value as weight', 'weights.remark')
            ->where('weights.id','=',$weightId) 
      
          ->get();
            $weight = json_decode(json_encode($users), true);
         return $weight;
    }
    public function updateWeightId(int $id): array
    {
         $weightId = \App\Weight::findOrFail($id);
        
            return $weightId;
    }
    public function deleteWeightId(int $id): array
    {
         $weight= \App\Weight::findOrFail($id);
         return $weight;
    }
    public function viewAllWeights(int $id):array
    {
        $userId= User::findOrFail($id)->id;
        $users = DB::table('users')
            ->join('weights', 'users.id', '=', 'weights.user_id')
            ->select('users.name', 'users.email','weights.id as weightId', 'users.created_at', 'users.updated_at', 'weights.value as weight', 'weights.remark')
            ->where('users.id', '=', $userId)->orderBy('weights.id')
            ->get();
             $weight = json_decode(json_encode($users), true);
         return $weight;
    }
   public function lastNumberWeights(int $userId, int $numberId):array{
         $userId= User::findOrFail($userId)->id;
     //  dd($id);
        
      $weight = Weight::orderBy('created_at','desc')->take($numberId)->where('user_id', $userId)->get();
         $weight1 = json_decode(json_encode($weight), true);
         return $weight1;
   }
}
   
