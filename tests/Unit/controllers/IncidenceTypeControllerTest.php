<?php

namespace Tests\Unit\controllers;
use App\IncidenceType;
use Tests\TestCase;
use App\User;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class IncidenceTypeControllerTest extends TestCase
{
 
 	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('incidence-type.index'));
        $response->assertStatus(200);
    }


    /**
     *
     * @return void
     */
    public function testCreateIncidence()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('POST',route('incidence-type.store'),['type' => 'Incidence A']);
        $response->assertStatus(201);
    }

    /**
     *
	 * @return void 
	 */
    public function testShowIncidence()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $incidence = factory(IncidenceType::class)->create();
        $this->assertNotNull($incidence->id);
        $response = $this->json('GET',route('incidence-type.show',['incidence_type' => $incidence->id]));
        $response->assertStatus(200)->assertJson([
            'data' => [
            	'type' => $incidence->type,
            	'id' => $incidence->id
            ],
        ]);
    }


    public function testUpdateIncidence()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $incidence = factory(IncidenceType::class)->create();
        $this->assertNotNull($incidence->id);
        $response = $this->json('PUT',route('incidence-type.update',['incidence_type' => $incidence->id]), ['type' => 'Actualizacion']);
        $response->assertStatus(200)->assertJson([
           	'type' => 'Actualizacion',
          	'id' => $incidence->id
        ]);
    }


    public function testDeleteIncidence()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $incidence = factory(IncidenceType::class)->create();
        $this->assertNotNull($incidence->id);
        $response = $this->json('DELETE',route('incidence-type.destroy',['incidence_type' => $incidence->id]));
        $response->assertStatus(204);
    }
}
