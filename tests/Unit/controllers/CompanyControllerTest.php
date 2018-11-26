<?php

namespace Tests\Unit\controllers;
use App\Company;
use App\Document;
use App\CompanyType;
use App\IncidenceType;
use App\User;
use App\Requeriment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class CompanyControllerTest extends TestCase
{
 	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('company.index'));
        $response->assertStatus(200);
    }

    /**
     *
	 * @return void 
	 */
  public function testShowCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(Company::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('GET',route('company.show',['company' => $company->id]));
        $response->assertStatus(200);
    }

    public function testUpdateCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $type = factory(CompanyType::class)->create();
        $r1 = $requeriment = factory(Requeriment::class)->create();
        $r2 = $requeriment = factory(Requeriment::class)->create();
        $r3 = $requeriment = factory(Requeriment::class)->create();
        $company = factory(Company::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('PUT',route('company.update',['company' => $company->id]),[
        	'company' => [
	        	'identity' => 'C-000000000',
				'name'  =>' Company Test',
				'email'  =>'company@test.com',
				'phone'  =>'0414-7896541',
				'address'  =>'Barquisimeto',
				'company_type_id'  => $type->id
        	],
        	'contact' => [
		        'name'  => 'Jose',
		        'email' => 'jose@test.com',
		        'phone' => '04145679898',
		        'role' => 'test'
        	]
        ]);
        $response->assertStatus(200);
    }

    public function testDeleteCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(Company::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('DELETE',route('company.destroy',['document' => $company->id]));
        $response->assertStatus(204);
    }

    public function testReprobarCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(Company::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('DELETE',route('company.reprobar',['document' => $company->id]));
        $response->assertStatus(200);
    }

    public function testAprobarCompany()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(Company::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('PUT',route('company.procesar',['document' => $company->id]));
        $response->assertStatus(200);
    }

    public function testCearIncidencia()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $company = factory(Company::class)->create();
        $type = factory(IncidenceType::class)->create();
        $document = factory(Document::class)->create();
        $this->assertNotNull($company->id);
        $response = $this->json('POST',route('company.incidecia',[
            'description' => 'Soy un test ',
            'incidence_type_id' => $type->id,
            'document_id' => $document->id,
            'document' => $document->id,
            'company' => $company->id
        ]));
        // echo $response->getContent();
        $response->assertStatus(201);
    }
}