<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cliente 1
        $user = User::create([
            'ci'=>'9876655',
            'name' => 'Carla',
            'lastname' => 'Cruz',
            'gender' => 'F',
            'birth_date' => '1999-12-12',
            'number_phone' => '69502321',
            'email' => 'carla@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');;

        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Carla.jpeg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
        //cliente 2
        $user = User::create([
            'ci'=>'211255329',
            'name' => 'Johan',
            'lastname' => 'Quispe',
            'gender' => 'M',
            'birth_date' => '1998-11-14',
            'number_phone' => '60412132',
            'email' => 'johan@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');

        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/JohanQuispe.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
        //cliente 3
        $user = User::create([
            'ci'=>'33221323',
            'name' => 'Marco',
            'lastname' => 'Padilla',
            'gender' => 'M',
            'birth_date' => '1993-09-14',
            'number_phone' => '66381032',
            'email' => 'marco@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');

        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Marco.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
        //cliente 4
        $user = User::create([
            'ci'=>'73818782',
            'name' => 'Pedro',
            'lastname' => 'Sarabia',
            'gender' => 'M',
            'birth_date' => '2000-03-11',
            'number_phone' => '76238294',
            'email' => 'pedro@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');

        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Pedro.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
        //cliente 5
        $user = User::create([
            'ci'=>'93938229',
            'name' => 'Ruben',
            'lastname' => 'Suarez',
            'gender' => 'M',
            'birth_date' => '1993-11-01',
            'number_phone' => '1112121',
            'email' => 'ruben@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');
        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]); 
        $image= new Image([
            'url'=>'perfil/Ruben.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
        //cliente 6
        $user = User::create([
            'ci'=>'76428229',
            'name' => 'Naida',
            'lastname' => 'Vera',
            'gender' => 'F',
            'birth_date' => '1993-03-11',
            'number_phone' => '76238294',
            'email' => 'naida@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');
        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Naida.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
         //cliente 7
         $user = User::create([
            'ci'=>'27187122',
            'name' => 'Sabrina',
            'lastname' => 'Lopez',
            'gender' => 'F',
            'birth_date' => '2000-07-31',
            'number_phone' => '76238294',
            'email' => 'sabrina@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');
        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Sabrina.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);

         //cliente 8
         $user = User::create([
            'ci'=>'683782821',
            'name' => 'Karoline',
            'lastname' => 'Heredia',
            'gender' => 'F',
            'birth_date' => '1998-03-11',
            'number_phone' => '75453453',
            'email' => 'karoline@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');
        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/karoline.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
         //cliente 9
         $user = User::create([
            'ci'=>'76111229',
            'name' => 'Karen',
            'lastname' => 'Miranda',
            'gender' => 'F',
            'birth_date' => '2000-01-12',
            'number_phone' => '7983298',
            'email' => 'karen@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');
        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Karen.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
         //cliente 10
         $user = User::create([
            'ci'=>'92983221',
            'name' => 'Orlando',
            'lastname' => 'Huascar',
            'gender' => 'F',
            'birth_date' => '1994-03-11',
            'number_phone' => '67564455',
            'email' => 'orlando@gmail.com',
            'tipo' => 'C',
            'password' => bcrypt('12345678')
        ])->assignRole('Cliente');
        Cliente::create([
            'id' => $user->id,
            'shipping_address'=>'Calle Santiago',
            'gps'=>'-17.77313,-63.19524'
        ]);
        $image= new Image([
            'url'=>'perfil/Orlando.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
    }
}
