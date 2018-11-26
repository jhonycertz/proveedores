<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Requeriment;

class DocumentType extends Model
{
    use SoftDeletes;
    protected $fillable = ['type'];
    protected $hidden = ['created_at','updated_at','delete_at'];

}
