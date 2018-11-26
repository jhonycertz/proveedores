<?php

namespace App;
use App\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCompany extends Model
{
    protected $fillable = ['name','phone','company_id'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
