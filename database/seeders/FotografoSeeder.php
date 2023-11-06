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
            'url' => 'perfil/Christian.jpeg',
            'tipo' => 'P'
        ]);
        $user->images()->save($image);
        //IMAGEN FOTOGRAFO

        $imagenes = [
            [
                'url' => 'galeria_imagenes_fotografo/IMG-20190519-WA0017.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/IMG-20190519-WA0052.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/IMG-20190825-WA0094.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/IMG-20190924-WA0071.jpg',
                'tipo' => 'F'
            ],
            [
                'url' => 'galeria_imagenes_fotografo/IMG-20190924-WA0087.jpg',
                'tipo' => 'F'
            ]
        ];
        foreach ($imagenes as $img) {
            $image=new Image($img);
            $user->images()->save($image);
        }
    }
}
