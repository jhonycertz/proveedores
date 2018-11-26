<?php

namespace Tests\Unit;

use App\CompanyType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class RegisterCompanyControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testCreateRegisterCompany()
    {
        $type = factory(CompanyType::class)->create();
        $response = $this->json('POST',route('register.company'),[
        	'company' => [
	        	'identity' => 'C-000000000',
						'name'  =>' Company Test',
						'email'  =>'company@test.com',
						'phone'  =>'0414-4079304',
						'address'  =>'Carabobo',
						'company_type_id'  => $type->id,
						'catalogo_path'  => UploadedFile::fake()->create('document.pdf', 1500 )
        	],
        	'contact' => [
		        'name'  => 'Jean',
		        'email' => 'Jean@test.com',
		        'phone' => '04144079304',
		        'role' => 'test'
        	], 
        	'customers' => [
        		['name' => 'IBM', 'phone' => '1234'],
        		['name' => 'Heinz', 'phone' => '1234']
        	]
        ]);
        $response->assertStatus(201);
    }
}
