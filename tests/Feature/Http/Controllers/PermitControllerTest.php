<?php

namespace tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use App\User;
use App\Permit;

class PermitControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
     /*
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    } */

    public function test_permit_store(){
      $user = factory(\App\User::class)->create();

      $permit_dates = array(array(
        'date' => date('Y-m-d',time()+14*24*60*60),
        'start_at' => '08:00:00',
        'end_at' => '17:00:00'
      ));

      $response = $this->actingAs($user)
      ->post(route('apipermit.store'),[
        'user_id' => $user->id,
        'type' => 'full time',
        'desc' => $this->faker->words(2,true),
        'status' => 'pending',
        'permit_date' => $permit_dates
      ]);

      $response->assertStatus(200);
    }

    public function test_permit_getall(){
      $response = $this->get('/api/permits');
      $response->assertStatus(200);
    }

    
    public function test_permit_getdetail(){
        $response = $this->get('/api/permits/'.rand(1,100));
        $response->assertStatus(200);
    }

    public function test_it_should_success_when_creating_permits_by_the_rules(){
      $user = factory(\App\User::class)->create();

      $permit_dates = array(array(
        'date' => date('Y-m-d',time()+14*24*60*60),
        'start_at' => '08:00:00',
        'end_at' => '17:00:00'
      ));

      $response = $this->actingAs($user)
          ->post(route('apipermit.store'),[
              'user_id' => $user->id,
              'type'    => 'full time',
              'desc'    => 'test desc',
              'status' => 'pending',
              'permit_date' => $permit_dates
          ]);

      $response->assertStatus(200);
  }
  
    public function test_it_should_fail_when_creating_permits_without_type(){
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
            ->json('POST', 'api/permits', [
                'user_id' => $user->id,
                'desc'    => 'test desc',
                'status' => 'pending'
            ]);

        $response->assertStatus(422);
    }

    public function test_it_should_fail_when_creating_permits_with_wrong_type(){
      $user = factory(\App\User::class)->create();

      $response = $this->actingAs($user)
          ->json('POST', 'api/permits', [
              'user_id' => $user->id,
              'type'    => '1111',
              'desc'    => 'test desc',
              'status'  => 'pending'
          ]);

      $response->assertStatus(422);
  }
}
