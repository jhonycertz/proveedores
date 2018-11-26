<?php

namespace App;
use App\Company;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = ['company_id', 'user_id', 'admin'];
    protected $casts = [
        'admin' => 'bolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
