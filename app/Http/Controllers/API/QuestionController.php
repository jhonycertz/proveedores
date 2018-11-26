<?php

namespace App\Http\Controllers\API;

use App\Question;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionReplyResource;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $type = $request->input('search');
        $query = Question::with(['client.company'])->when($type, function($query) use ($type){
            return $query->where('question','like','%'. $type .'%');
        })
        ->orderBy('status','asc')
        ->orderBy('id','desc');
        return QuestionResource::collection($query->paginate(12));
    }

 
    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionReplyResource($question);
    }
 
}
