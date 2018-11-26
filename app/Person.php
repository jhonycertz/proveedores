<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Company;

class Person extends Model
{
    protected $fillable = ['name','email','phone','role','company_id'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
