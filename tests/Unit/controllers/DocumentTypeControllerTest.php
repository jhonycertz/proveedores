<?php

namespace Tests\Unit\controllers;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\DocumentType;
use Laravel\Passport\Passport;

class DocumentTypeControllerTest extends TestCase
{
 	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('document-type.index'));
        $response->assertStatus(200);
    }


    /**
     *
     * @return void
     */
    public function testCreateDocument()
    {
       Passport::actingAs(factory(User::class)->create(),['create-servers']);        
       $response = $this->json('POST',route('document-type.store'),['type' => 'Document A']);
        $response->assertStatus(201);
    }

    /**
     *
	 * @return void 
	 */
    public function testShowDocument()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $document = factory(DocumentType::class)->create();
        $this->assertNotNull($document->id);
        $response = $this->json('GET',route('document-type.show',['document_type' => $document->id]));
        $response->assertStatus(200)->assertJson([
            'data' => [
            	'type' => $document->type,
            	'id' => $document->id
            ],
        ]);
    }


    public function testUpdateDocument()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $document = factory(DocumentType::class)->create();
        $this->assertNotNull($document->id);
        $response = $this->json('PUT',route('document-type.update',['document_type' => $document->id]), ['type' => 'Actualizacion']);
        $response->assertStatus(200)->assertJson([
           	'type' => 'Actualizacion',
          	'id' => $document->id
        ]);
    }


    public function testDeleteDocument()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $document = factory(DocumentType::class)->create();
        $this->assertNotNull($document->id);
        $response = $this->json('DELETE',route('document-type.destroy',['document_type' => $document->id]));
        $response->assertStatus(204);
    }

}
