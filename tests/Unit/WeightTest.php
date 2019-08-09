<?php

namespace Tests\Unit;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Weight;
use Illuminate\Support\Facades\DB;
class WeightTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAddWeight()
    {
 $weight = ['value' => '69', 'remark' => 'first weight'];
 dd($weight);
       
         $this->json('POST', '/weights', $weight)
                  ->assertStatus(Response::HTTP_CREATED)
                 //Утвердите, что ответ содержит точное соответствие данных JSON:
                 ->assertExactJson([
                'created' => true,
            ]);
      
    }
}
