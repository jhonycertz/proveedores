<?php

namespace App;

use App\RequerimentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requeriment extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','code','required','requeriment_type_id'];
    protected $hidden = ['created_at','updated_at','delete_at'];
    protected $casts = ['required' => 'boolean'];
    public function requerimentType()
    {
        return $this->belongsTo(RequerimentType::class);
    }

}
