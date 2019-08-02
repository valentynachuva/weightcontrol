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
            //TODO у тебя уже есть user еще раз его дергать не надо
           'user_id' => $user->id
            
        ]);

        //TODO так как мы делаем API и этот метода на создание ресурса, то надо вернуть 201 и заголовок Location
        return response()->json(null, Response::HTTP_CREATED, [
            //TODO еще будет меняться когда будет у тебя роут на получения веса по ID
            'Location' => $weightId
        ]);
    }
    public function weightId(Request $request)
    {
        
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
