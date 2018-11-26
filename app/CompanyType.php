<?php

namespace App;

use App\Requeriment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyType extends Model
{
    use SoftDeletes;

    protected $fillable = ['type'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function requeriments()
    {
        return $this->belongsToMany(Requeriment::class);
    } 

}
