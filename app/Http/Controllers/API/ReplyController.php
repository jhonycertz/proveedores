<?php

namespace App\Http\Controllers\API;

use App\Reply;
use App\Question;
use App\Http\Resources\ReplyResource;
use App\Http\Requests\ReplyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class ReplyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $search = $request->input('search');
        $questionId = $request->input('question_id');
        $query = Reply::where('question_id', $questionId)->when($search, function($query) use ($search){
            return $query->where('reply','like','%'. $search .'%');
        })
        ->orderBy('id','desc');
        return ReplyResource::collection($query->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request)
    {
        $validated = $request->validated();
        $question = Question::find($validated['question_id']);
        $reply = null;
        $validated['user_id'] = Auth::user()->id;
        DB::transaction(function () use(&$reply,&$validated,&$question) {
            $reply = Reply::create($validated);
            $question->status = 'procesada';
            $question->save();
        });
       return new ReplyResource($reply,202);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, Reply $reply)
    {
        $validated = $request->validated();
        $reply->update($validated);
        return new ReplyResource($reply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
        return response()->json([],204);
    }
}
