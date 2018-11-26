<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use SoftDeletes;
    /*
     * The attributes that are mass assignable 
     * @var array
     */
    protected $fillable = ['operation','group'];

    /*
     * The attributes that are mass assignable 
     * @var array
     */
    protected $casts = [ 
        'operation' => 'string',
        'group' => 'string'
    ];  
}
