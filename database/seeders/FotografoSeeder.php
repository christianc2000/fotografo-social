<?php

namespace Database\Seeders;

use App\Models\Fotografo;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;

class FotografoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'ci' => '9821736',
            'name' => 'Christian Celso',
            'lastname' => 'Mamani Soliz',
            'gender' => 'M',
            'birth_date' => '2000-01-04',
            'number_phone' => '77376902',
            'email' => 'christian@gmail.com',
            'tipo' => 'F',
            'password' => bcrypt('12345678')
        ])->assignRole('Fotografo');

        Fotografo::create([
            'id' => $user->id,
            'descripcion' => "Imagenes con buen enfoque"
        ]);
        //PERFIL FOTOGRAFO
        $image = new Image([
            'url' => 'perfil/b5Q97N6jUF0iLyrjFQn0CQpvNSlCUm5z2WKnbF07.jpg',
            'tipo' => 'P'
        ]);
        $user->images()->save($image);
        //IMAGEN FOTOGRAFO

        $imagenes = [
            [
                'url' => 'galeria_imagenes_fotografo/aUxBG4MnObyfDMEPv12MHEy8GSXfqoUstIwEOsBI.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/hzhctvi11YjRxkNkHdAZvFEen3xn5ZSJBgFtOPSW.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/h0O0JhJygwfjvLRx6byKTnX3IJvZ1GBdrbsmFxBo.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/GFNKP0idTWkzMGnKe1wZir9vJby1UcUIvmxpwoE3.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/FncvOrtoUQgb69oHCTs82jHoDODO8VmlPMuJOH0q.jpg',
                'tipo' => 'F'
            ],
        ];
        foreach ($imagenes as $img) {
            $image=new Image($img);
            $user->images()->save($image);
        }
    }
}
