<?php

namespace Tests\Unit\relations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Role;

class RoleTest extends TestCase
{
 	use RefreshDatabase;

    /**
     * @return void
     */
    public function testCreateRole()
    {
    	$role = Role::create(['role'=> 'administration xyz']);
    	$this->assertEquals($role->role, 'administration xyz');
	    $this->assertDatabaseHas('roles', [
            'role' => 'administration xyz',
	    ]);
    }

    /**
     * @return void 
     */
    public function testDeleteRole()
    {
        $role = factory(Role::class)->states('Administration')->create();
        $role->delete();
        $this->assertTrue($role->trashed());
    }
}
