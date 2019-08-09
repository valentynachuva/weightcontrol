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

    /**
     *
     * @param WeightRepositoryInterface $weightRepository
     */

    public function __construct(WeightRepositoryInterface $weightRepository)
    {
        $this->middleware('jwt.auth');
        $this->weightRepository = $weightRepository;
    }

    /**
     *
     * @return type
     */
    public function index()
    {
        if (Auth::check()) {

            $userId = $this->getUser()->id;
            $weights = $this->weightRepository->viewAllWeights($userId);
            unset($weights->user_id);
            unset($weights->created_at);
            unset($weights->updated_at);
            $weight = $weights;

            return response()->json($weight, Response::HTTP_OK);
        } else {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function show(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $id = $request->id;
            if (\App\Weight::where('user_id', $userId)->where('id', $id)->first()) {
                $weightId = $this->weightRepository->findWeightId($id, $userId);
                unset($weightId->created_at);
                unset($weightId->updated_at);
                $weight = $weightId;
                return response()->json($weight, Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['weightId' => 'such weightId couldn`t be found.']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'value' => 'required',
            ]);
            $weightId = $this->weightRepository->addWeight([
                'value' => request('value'),
                'remark' => request('remark'),
                'user_id' => $this->getUser()->id
            ]);

            return response()->json(null, Response::HTTP_CREATED, [
                'Location' => $weightId
            ]);
        }

    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function update(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $id = $request->id;
            if (\App\Weight::where('user_id', $userId)->where('id', $id)->first()) {

                $weightId = $this->weightRepository->updateWeightId($id);
                $weightId->update($request->all());

                return response()->json($weightId, 200);
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['weightId' => 'such weightId couldn`t be found.']
                ], Response::HTTP_NOT_FOUND);

            }
        }
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function delete(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $id = $request->id;
            if (\App\Weight::where('user_id', $userId)->where('id', $id)->first()) {

                $weightId = $this->weightRepository->deleteWeightId($id);
                $weightId->delete($request->all());
                return response()->json(null, Response:: HTTP_NO_CONTENT);
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['id' => 'such weightId couldn`t be found.']
                ], Response::HTTP_NOT_FOUND);

            }

        }
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function findLastNumberWeight(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $numberId = $request->id;

            if (\App\Weight::where('user_id', $userId)->first()) {
                $nubmerWeights = \App\Weight::where('user_id', $userId)->count('id');
                if ($numberId > $nubmerWeights) {


                    return response()->json([
                        'message' => 'The given data was invalid.',
                        'errors' => ['number of weights' => 'such number of weights couldn`t be found.']
                    ], Response::HTTP_NOT_FOUND);;
                }
                $weight = $this->weightRepository->lastNumberWeights($userId, $numberId);


                return response()->json($weight, Response::HTTP_OK);
            }

        }
    }

    /**
     *
     * @param Request $request
     * @return type
     */
    public function dates(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            if (\App\Weight::where('user_id', $userId)->first()) {
                $this->validate($request, [
                    'from' => 'required',
                    'to' => 'required'
                ]);
                $data['from'] = $request['from'];
                $data['to'] = $request['to'];
                $weights = $this->weightRepository->weightsBetweenDates($userId, $data);
                return response()->json($weights, Response::HTTP_OK);
            }
        }
    }
}

