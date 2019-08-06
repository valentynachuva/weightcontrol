<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Repository\WeightRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeightController extends Controller
{
    private $weightRepository;

    // private $weightId;

    public function __construct(WeightRepositoryInterface $weightRepository)
    {
        $this->middleware('jwt.auth');
        $this->weightRepository = $weightRepository;
    }

    public function index()
    {
        if (Auth::check()) {

            $userId = $this->getUser()->id;
            $weightId = $this->weightRepository->viewAllWeights($userId);

            return response()->json($weightId, Response::HTTP_OK);
        } else {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }
    }

    public function show(Request $request)
    {
        $userId = $this->getUser()->id;
        $id = $request->id;
        if (\App\Weight::where('user_id', $userId)->where('id', $id)->first()) {
            $weightId = $this->weightRepository->findWeightId($id);
            unset($weightId->created_at);
            unset($weightId->updated_at);
            $weight = $weightId;
            return response()->json($weight, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'such weightId not found' ], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'value' => 'required',
            ]);
            $weightId = $this->weightRepository->addWeight([
                'value' => request('value'),
                'remark' => request('remark'),
                ///       //TODO у тебя уже есть user еще раз его дергать не надо
                'user_id' => $this->getUser()->id
            ]);
            //TODO так как мы делаем API и этот метода на создание ресурса, то надо вернуть 201 и заголовок Location
            return response()->json(null, Response::HTTP_CREATED, [
                //      //TODO еще будет меняться когда будет у тебя роут на получения веса по ID
                'Location' => $weightId
            ]);
        }

    }

    public function update(Request $request)
    {
        $userId = $this->getUser()->id;
        $id = $request->id;
        if (\App\Weight::where('user_id', $userId)->where('id', $id)->first()) {
            // $id=$request->id;
            $weightId = $this->weightRepository->updateWeightId($id);
            $weightId->update($request->all());

            return response()->json($weightId, 200);
        } else {
            return response()->json(['message' => 'Couldn`t update, such weightId not found'],
                Response::HTTP_NOT_FOUND);
        }
    }

    public function delete(Request $request)
    {
        $userId = $this->getUser()->id;
        $id = $request->id;
        if (\App\Weight::where('user_id', $userId)->where('id', $id)->first()) {

            //$id=$request->id;
            $weightId = $this->weightRepository->deleteWeightId($id);
            $weightId->delete($request->all());
            return response()->json(null, Response:: HTTP_NO_CONTENT);
        } else {
            return response()->json(['message' => 'Couldn`t delete, such weightId not found'],
                Response::HTTP_NOT_FOUND);
        }
    }

    public function findLastNumberWeight(Request $request)
    {
        $userId = $this->getUser()->id;
      //dd($userId);
        $numberId = $request->id;
    
        if (\App\Weight::where('user_id', $userId)->first()){
            
            $nubmerWeights = \App\Weight::where('user_id',$userId)->count('id');
          if($numberId>$nubmerWeights) {
         
       
             return response()->json(['message' => 'such number of weights not found'],
                Response::HTTP_NOT_FOUND);
          }
              $weight = $this->weightRepository->lastNumberWeights($userId,$numberId);
        

            return response()->json($weight, Response::HTTP_OK);
        } else
       {
            return response()->json(['message' => 'such weights for you not found'],
                Response::HTTP_NOT_FOUND);
        }

    }
}
