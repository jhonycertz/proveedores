<?php

namespace App;
use App\User;
use App\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dates extends Model
{
    use SoftDeletes;
    protected $fillable = ['date','created_by','company','attendant','attendant_mail',
    'attendant_phone'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function owner(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function company(){
        return $this->belongsTo(Company::class, 'company', 'id');
    }
}
