<?php

namespace App;

use App\IncidenceType;
use App\RequerimentComapny;
use App\Document;
use App\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    use SoftDeletes;
    protected $fillable = ['description','incidence_type_id','requeriment_company_id','document_id','user_id'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function incidenceType()
    {
        return $this->belongsTo(IncidenceType::class);
    }

    public function requerimentCompany()
    {
        return $this->belongsTo(RequerimentComapny::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
