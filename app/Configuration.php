<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['name','aprobation_count'];
    protected $hidden = ['created_at','updated_at','delete_at'];
}
