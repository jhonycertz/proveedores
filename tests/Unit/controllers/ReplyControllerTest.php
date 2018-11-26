<?php

namespace Tests\Unit\controllers;
use App\Reply;
use App\User;
use App\Question;
use App\Http\Resources\ReplyResource;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class ReplyControllerTest extends TestCase
{
 	use RefreshDatabase;

    public static function setUpBeforeClass()
    {

    }
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('reply.index'));
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testCreateReply()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
    	//$user = factory(User::class)->create();
    	$question = factory(Question::Class)->create();
        $response = $this->json('POST',route('reply.store'), [ 
        	'reply' => 'Reply A',
        	'question_id' => $question->id,
        	//'user_id' => $user->id
        ]);
        $response->assertStatus(201);
        $question = Question::find($question->id);
        $this->assertEquals($question->status,'procesada');
    }

    /**
     *
	 * @return void 
	 */
    public function testShowReply()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $reply = factory(Reply::class)->create();
        $this->assertNotNull($reply->id);
        $response = $this->json('GET',route('reply.show',['reply' => $reply->id]));
        $replyResource = new ReplyResource($reply);
        $response->assertStatus(200)->assertJson([
            'data' => [
                'id'=> $reply->id,
                'reply' =>  $reply->reply,
            ]
        ]);
    }


    public function testUpdateReply()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $reply = factory(Reply::class)->create();
        $this->assertNotNull($reply->id);
        $response = $this->json('PUT',route('reply.update',['reply' => $reply->id]), ['reply' => 'Actualizacion']);
        $replyResource = new ReplyResource(Reply::find($reply->id));
        $response->assertStatus(200)->assertJson([
            'data' => [
                'id'=> $reply->id,
                'reply' => 'Actualizacion',
            ]
        ]);
    }


    public function testDeleteReply()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $reply = factory(Reply::class)->create();
        $this->assertNotNull($reply->id);
        $response = $this->json('DELETE',route('reply.destroy',['reply' => $reply->id]));
        $response->assertStatus(204);
    }
   
}
