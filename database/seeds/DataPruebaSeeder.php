<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
use App\IncidenceType;
use App\CompanyType;
use App\Company;
use App\Client;
use App\Question;
use App\Role;
use App\Requeriment;
use App\RequerimentType;
use App\User;
use App\DocumentType;

class DataPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DocumentType::create(['type' => 'Documento 1']);
        IncidenceType::create(['type' => 'Documento Dañado']);
        IncidenceType::create(['type' => 'Imagen Defectuosa']);
        IncidenceType::create(['type' => 'Falta de documento']);
        IncidenceType::create(['type' => 'Documento Vencido']);

        $c1 = CompanyType::create(['type'=> ' Agro-Industria ' ]);
        $c2 = CompanyType::create(['type'=> 'Vigilancia' ]);
        $c3 = CompanyType::create(['type'=> 'Alimentos']);
        $c4 = CompanyType::create(['type'=> 'Otros' ]);

        for ($i=0; $i < 10; $i++) { 
            Company::create([
                'name' => 'company n° '. $i, 
                'identity' => 'C-000'.$i,
                'address' =>'adress ',
                'phone' => 'phone',
                'company_type_id' => $c1->id,
                'email' => $faker->email,
                'catalogo_path' => $faker->md5() ."pdf"
                ]);
        }

        $client=  Client::create(['username' => 'client','password' => Hash::make('1234'),'company_id' => Company::first()->id ]);
        
        for($i = 0; $i < 25; $i++){
            Question::create([
                'question' => $faker->text(),
                'client_id' => $faker->randomElement(Client::pluck('id')->toArray())
            ]);
            
            Requeriment::create([
                'name' => $faker->name,
                'code'  => $faker->numerify('R'.$faker->randomLetter().'-###'),
                'required'  => $faker->boolean(),
                'requeriment_type_id'  => factory(RequerimentType::class)->create()->id,                
            ]);
        }
        $roleAdmin = Role::create(['role' => 'Administrador']);
        $user = User::create([
            'role_id' => $roleAdmin->id,
            'surname' => 'Heinz',
            'name' => 'Heinz',
            'email' => 'KraftHeinzVzlaProveedores@gmail.com',
            'password' => Hash::make('1234')
        ]);
    }
}
