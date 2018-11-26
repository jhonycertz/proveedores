<?php

namespace App;

use App\User;
use App\Question;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['reply','question_id','user_id'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
