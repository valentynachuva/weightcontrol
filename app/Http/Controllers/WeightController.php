<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Repository\WeightRepositoryInterface;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    private $weightRepository;


   public function __construct(WeightRepositoryInterface $weightRepository)
    {
     $this->middleware('jwt.auth');
       $this->weightRepository = $weightRepository;
    }

     public function index()
    {if (Auth::check()) {
    /**
     * После проверки уже можешь получать любое свойство модели
     * пользователя через фасад Auth, например id
     */
    $user = Auth::user();
 
    $user= \App\Weight::all();
    
     return response($user, 200);
}
      //  $user = Auth::user();
        return response(404);
    }
 
    public function show(Request $request)
    {
        $id= $request->id;
      //  dd($id);
       $weightId= $this->weightRepository->findWeightId($id);
        unset($weightId->created_at);
        unset($weightId->updated_at);   
       unset($weightId->created_at);
        $weight = $weightId;
    
    return response()->json($weight,200);
    }
     public function store(Request $request)
   {
       $user = Auth::user();
        $this->validate($request, [
          'value' => 'required',
       ]);

        // TODO Не совсем понятна магия с json_decode json_encode
        //$weightRepository= json_decode(json_encode($this->weightRepository), true);

        $weightId = $this->weightRepository->addWeight([
           'value' => request('value'),
           'remark' => request('remark'),
     ///       //TODO у тебя уже есть user еще раз его дергать не надо
         'user_id' => $user->id
            
       ]);
        //TODO так как мы делаем API и этот метода на создание ресурса, то надо вернуть 201 и заголовок Location
       return response()->json(null, Response::HTTP_CREATED, [
      //      //TODO еще будет меняться когда будет у тебя роут на получения веса по ID
         'Location' => $weightId
       ]);
    }
    
    
    public function update(Request $request, $id)
            
    {
        $id=$request->id;
        //dd($id);
       $weightId= $this->weightRepository->updateWeightId($id);
         $weightId->update($request->all());
      
        return response()->json($weightId, 200);
    }

    public function delete(Request $request, $id)
    {
        $id=$request->id;
        //dd($id);
       $weightId= $this->weightRepository->deleteWeightId($id);
         $weightId->delete($request->all());
    

        return response()->json(null, Response:: HTTP_NO_CONTENT);
    }
}
