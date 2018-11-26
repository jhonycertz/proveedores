<?php

namespace Tests\Unit\controllers;

use App\Question;
use App\User;
use App\Http\Resources\QuestionReplyResource;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class QuestionControllerTest extends TestCase
{

	use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $response = $this->json('GET',route('question.index'));
        $response->assertStatus(200);
    }

    /**
     *
	 * @return void 
	 */
    public function testShow()
    {
        Passport::actingAs(factory(User::class)->create(),['create-servers']);        
        $question = factory(Question::class)->create();
        $this->assertNotNull($question->id);
        $response = $this->json('GET',route('question.show',['question' => $question->id]));
        $response->assertStatus(200);
    }

}
