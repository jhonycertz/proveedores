<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Requeriment;
use App\Company;

class RequerimentCompany extends Model
{
    use SoftDeletes;
    protected $fillable = ['requeriment_id','company_id','required'];

    protected $hidden = ['created_at','updated_at','delete_at'];

    public function requeriment()
    {
    	return $this->belongsTo(Requeriment::class);
    }

    public function company()
    {
    	return $this->belongsTo(Company::class);
    }

}
