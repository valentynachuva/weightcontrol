<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Repository\WeightRepository;
use App\Repository\WeightRepositoryInterface;
use Illuminate\Http\Request;

class WeightController extends Controller
{
private $weightRepository;


public function __construct(WeightRepository $weightRepository)
 {
 $this->middleware('auth:api');
$this->weightRepository=$weightRepository;

}
  public function store(Request $request)
    {
      $user = Auth::user();
    // dd($user);
    $this->validate($request, [
          'value' => 'required',
        ]);
    $weightRepository= json_decode(json_encode($this->weightRepository), True);
   
          $weight = $this->weightRepository->addWeight($weightRepository);
        
              unset($weight->id);
            unset($weight->created_at);
            unset($weight->updated_at);
               
              $result = $weight;
             return response()->json($result);
    }
   
    
     public function update(Request $request)
    {
      $user = Auth::user();
       // dd($user);
        $this->validate($request, [
           'id' => 'required'
        ]);
    }
}
