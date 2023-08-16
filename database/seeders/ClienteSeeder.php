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
            'id' => $user->id
        ]);
        $image= new Image([
            'url'=>'perfil/Mvdgt1NIhD2DDWEhBPso3vBPIVPBYeIZS3yJmRcQ.jpg',
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
            'id' => $user->id
        ]);
        $image= new Image([
            'url'=>'perfil/AD6sYVUNHj551PrJf5Nkjm5yKkXzidJHDFi6IBQ6.jpg',
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
            'id' => $user->id
        ]);
        $image= new Image([
            'url'=>'perfil/GOVehSYyT7NRERAhM4L7weVPiIhAVetaUNhwC38m.jpg',
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
            'id' => $user->id
        ]);
        $image= new Image([
            'url'=>'perfil/fkM9dFr5MuyY0F2ZDxxSbbQnMoBZwLPggUfHDotD.jpg',
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
            'id' => $user->id
        ]); 
        $image= new Image([
            'url'=>'perfil/OWtkO6vMQdXHeAkoUGBLVtNXu2arVyKDYe7c6GzB.jpg',
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
            'id' => $user->id
        ]);
        $image= new Image([
            'url'=>'perfil/Yfct1KrfV6OJV8ySzbq6sIgA97bdyGnlXKyJCXR8.jpg',
            'tipo' => 'P',
        ]);
        $user->images()->save($image);
    }
}
