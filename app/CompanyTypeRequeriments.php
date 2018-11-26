<?php

namespace App;

use App\Requeriment;
use Illuminate\Database\Eloquent\Model;

class CompanyTypeRequeriments extends Model
{
    protected $table = 'company_type_requeriment';
    protected $fillable = ['requeriment_id', 'company_type_id'];

    public function requeriments()
    {
        return $this->belongsTo(Requeriment::class, 'requeriment_id', 'id');
    } 

}
