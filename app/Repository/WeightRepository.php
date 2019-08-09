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

    /**
     * @var Weight
     */
    private $model;

    public function __construct()
    {
        $this->model = app(Weight::class);
    }

    /**
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function viewAllWeights(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        $weight = Weight::where('user_id', $userId)->get();

        return $weight;
    }

    /**
     *
     * @param int $id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findWeightId(int $id, int $userId): \Illuminate\Database\Eloquent\Collection
    {
        $weightId = Weight::findOrFail($id)->id;
        $weight = Weight::where('user_id', $userId)->where('id', $weightId)->get();

        return $weight;
    }

    /**
     *
     * @param array $data
     * @return int
     */
    public function addWeight(array $data): int
    {
        $this->model->fill($data)->save();
        return $this->model->id;
    }

    /**
     *
     * @param int $id
     * @return Weight
     */
    public function updateWeightId(int $id): ?\App\Weight
    {
        $weightId = \App\Weight::findOrFail($id);
        return $weightId;
    }

    /**
     *
     * @param int $id
     * @return type
     */
    public function deleteWeightId(int $id)
    {
        $weight = \App\Weight::findOrFail($id);
        return $weight;
    }

    /**
     *
     * @param int $userId
     * @param int $numberId
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function lastNumberWeights(int $userId, int $numberId): \Illuminate\Database\Eloquent\Collection
    {

        $weight = Weight::orderBy('created_at', 'desc')->take($numberId)->where('user_id', $userId)->get();

        return $weight;
    }

    /**
     *
     * @param int $userId
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function weightsBetweenDates(int $userId, array $data): \Illuminate\Database\Eloquent\Collection
    {
        $weight = Weight::whereBetween('created_at', [$data['from'], $data['to']])->where('user_id', $userId)->get();

        return $weight;
    }
}

   
