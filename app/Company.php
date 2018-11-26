<?php

namespace App;
use Mail;
use App\CustomerCompany;
use App\Person;
use App\Client;
use App\CompanyType;
use App\Question;
use App\RequerimentType;
use App\Mail\AcceptedCompany;
use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','identity','address','phone','company_type_id','email','catalogo_path','status'];
    protected $hidden = ['created_at','updated_at','delete_at'];

    public function customer()
    {
        return $this->hasMany(CustomerCompany::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function aprobaciones()
    {
        return $this->hasMany(Approval::class);
    }

    public function aprobar($usuario)
    {
        $total =  $this->aprobaciones()->count();
        if( $total < 5)
        {
            $this->aprobaciones()->create(['company_id' => $this->id, 'user_id' => $usuario->id, 'admin' => $usuario->role_id == 1]);
        }
        $total =  $this->aprobaciones()->count();
        if($total == 5 )
        {
            $this->status = 'APROBADA';
            $this->update();
        }
    }

    public function procesar($data)
    {
        $requeriments = RequerimentType::all();
        $id = $this->id;
        $password = str_random(8);
        $user = hash('md5',$this->id);
        $datos = (object) array(
            'id' => $user, 
            'password' => $password,
            'requeriments' => $requeriments
        );
        $hashed_random_password = Hash::make($password);
        //$hashed = Hash::make($hashed_random_password);
        $client = Client::create(['username' => $user ,'password' => $hashed_random_password, 'textpassword' => $hashed_random_password, 'company_id'=> $this->id]);
        Log::debug($client);
        $this->update(['status' => 'EN-PROCESO']);
        Mail::to($data->email)->send(new AcceptedCompany($datos));
        return $client;
    }


    public static function createWithFile(array $attributes = [])
    {
       try
       {
          $companyAttributes = $attributes['company'];
          $file = $companyAttributes['catalogo_path'];
          $path = $file->store('public/companies');
          $companyAttributes['catalogo_path'] = $path;
          $company = self::create($companyAttributes);
          $company->people()->create($attributes['contact']);
          foreach ($attributes['customers'] as $value) {
            $company->customer()->create($value);
          }
          return $company;
       } 
       catch (Exception $e)
       {
          Storage::delete($path);         
          throw $e;
       }
    }

}
