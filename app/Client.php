<?php

namespace App;
use App\Company;
use App\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Client  extends Authenticatable
{   
    use HasApiTokens,Notifiable, SoftDeletes;

    protected $fillable = ['username','password','company_id','textpassword'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    protected $casts = [
        'username' => 'string',
        'password' => 'string'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);        
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'owner_id');
    }

}
