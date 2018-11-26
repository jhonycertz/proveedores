<?php

namespace Tests\Unit\relations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Operation;

class OperationTest extends TestCase
{
 	use RefreshDatabase;

    /**
     * @return void
     */
    public function testCreateOperation()
    {
    	$operation = Operation::create(['operation'=> 'Acces Client Module', 'group' => 'ABCDEF']);
    	$this->assertEquals($operation->operation, 'Acces Client Module');
	    $this->assertDatabaseHas('operations', [
            'operation' => 'Acces Client Module',
            'group' => 'ABCDEF',
	    ]);
    }

    /**
     * @return void 
     */
    public function testDeleteOperation()
    {
	    factory(Operation::class)->create();
	    $operation = Operation::latest()->first();
        $operation->delete();
        $this->assertTrue($operation->trashed());
    }
}
