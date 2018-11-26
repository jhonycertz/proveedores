<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Reply;

class Question extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['question','client_id'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function reply()
    {
        return $this->hasOne(Reply::class);
    }
}
