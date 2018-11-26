<?php

namespace Tests\Unit\controllers;
use App\CompanyType;
use App\User;
use App\Requeriment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class CompanyTypeControllerTest extends TestCase
{
 	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('company-type.index'));
        $response->assertStatus(200);
    }


    /**
     *
     * @return void
     */
    public function testCreateCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $r1 = $requeriment = factory(Requeriment::class)->create();
        $r2 = $requeriment = factory(Requeriment::class)->create();
        $r3 = $requeriment = factory(Requeriment::class)->create();
        $response = $this->json('POST',route('company-type.store'),
            [
                'type' => 'Company A',
                'requeriments' => [
                    ['id'=> $r1->id],
                    ['id'=> $r2->id],
                    ['id'=> $r3->id],
                ]
            ]);
        $response->assertStatus(201);
    }

    /**
     *
	 * @return void 
	 */
    public function testShowCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(CompanyType::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('GET',route('company-type.show',['company_type' => $company->id]));
        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => $company->id,
            	'type' => $company->type,
                'requeriments' => []
            ],
        ]);
    }

    public function testUpdateCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $r1 = $requeriment = factory(Requeriment::class)->create();
        $r2 = $requeriment = factory(Requeriment::class)->create();
        $r3 = $requeriment = factory(Requeriment::class)->create();
        $company = factory(CompanyType::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('PUT',
            route('company-type.update',['company_type' => $company->id]),
            [
                'type' => 'Company B',
                'requeriments' => [
                    ['id'=> $r1->id],
                    ['id'=> $r2->id],
                    ['id'=> $r3->id],
                ]
            ]);
        $response->assertStatus(200); //->assertJson([
        //    'data' => [
        //        'id' => $company->id,
        //        'type' => $company->type,
        //        'requeriments' => []
        //    ],
        //]);
    }
    

    public function testDeleteCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(CompanyType::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('DELETE',route('company-type.destroy',['document_type' => $company->id]));
        $response->assertStatus(204);
    }
 

}
