<?php

namespace Tests\Unit\controllers;

use App\Requeriment;
use App\RequerimentType;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class RequerimentControllerTest extends TestCase
{
	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('requeriment.index'));
        $response->assertStatus(200);
    }


    /**
     *
     * @return void
     */
    public function testCreateRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requerimentType = factory(RequerimentType::class)->create();
        $response = $this->json('POST',route('requeriment.store'),['name' => 'Requeriment A','code' => 'R1','required'=>true,'requeriment_type_id'=> $requerimentType->id]);
        $response->assertStatus(201);
    }

    /**
     *
	 * @return void 
	 */
    public function testShowRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requeriment = factory(Requeriment::class)->create();
        $this->assertNotNull($requeriment->id);
        $response = $this->json('GET',route('requeriment.show',['requeriment' => $requeriment->id]));
        $response->assertStatus(200)->assertJson([
            'data' => [
				'id' => $requeriment->id,
				'name'=> $requeriment->name,
				'code'=> $requeriment->code,
				'required'=> $requeriment->required,
				'requeriment_type' => [
					'id' => $requeriment->requerimentType->id,
					'type' => $requeriment->requerimentType->type,
				]	
            ],
        ]);
    }

    /**
     *
	 * @return void 
	 */
    public function testUpdateRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requeriment = factory(Requeriment::class)->create();
        $this->assertNotNull($requeriment->id);
        $response = $this->json('PUT',route('requeriment.update',['requeriment' => $requeriment->id]), [
        	'name' => 'Actualizacion',
			'code'=> $requeriment->code,
			'required'=> $requeriment->required,
			'requeriment_type_id' => $requeriment->requeriment_type_id        	
        ]);
        $response->assertStatus(200)->assertJson([
            'data' => [
				'id' => $requeriment->id,
				'name'=> 'Actualizacion',
				'code'=> $requeriment->code,
				'required'=> $requeriment->required,
				'requeriment_type' => [
					'id' => $requeriment->requerimentType->id,
					'type' => $requeriment->requerimentType->type,
				]
			]	
        ]);
    }

    /**
     *
	 * @return void 
	 */
    public function testDeleteRequeriment()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $requeriment = factory(Requeriment::class)->create();
        $this->assertNotNull($requeriment->id);
        $response = $this->json('DELETE',route('requeriment.destroy',['requeriment' => $requeriment->id]));
        $response->assertStatus(204);
    }

}
