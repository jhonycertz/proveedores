<?php

namespace Tests\Unit\controllers;
use App\RequerimentType;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class RequerimentTypeControllerTest extends TestCase
{
	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('requeriment-type.index'));
        $response->assertStatus(200);
    }


    /**
     *
     * @return void
     */
    public function testCreateRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('POST',route('requeriment-type.store'),['type' => 'Requeriment A']);
        $response->assertStatus(201);
    }

    /**
     *
	 * @return void 
	 */
    public function testShowRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requeriment = factory(RequerimentType::class)->create();
        $this->assertNotNull($requeriment->id);
        $response = $this->json('GET',route('requeriment-type.show',['requeriment_type' => $requeriment->id]));
        $response->assertStatus(200)->assertJson([
            'data' => [
            	'type' => $requeriment->type,
            	'id' => $requeriment->id
            ],
        ]);
    }


    public function testUpdateRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requeriment = factory(RequerimentType::class)->create();
        $this->assertNotNull($requeriment->id);
        $response = $this->json('PUT',route('requeriment-type.update',['requeriment_type' => $requeriment->id]), ['type' => 'Actualizacion']);
        $response->assertStatus(200)->assertJson([
           	'type' => 'Actualizacion',
          	'id' => $requeriment->id
        ]);
    }


    public function testDeleteRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requeriment = factory(RequerimentType::class)->create();
        $this->assertNotNull($requeriment->id);
        $response = $this->json('DELETE',route('requeriment-type.destroy',['requeriment_type' => $requeriment->id]));
        $response->assertStatus(204);
    }
}
