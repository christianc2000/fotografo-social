<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Organizador;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrganizadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'ci' => '98112233',
            'name' => 'organizador',
            'lastname' => 'organizador',
            'gender' => 'M',
            'birth_date' => '1990-12-12',
            'number_phone' => '73268293',
            'email' => 'organizador@gmail.com',
            'tipo' => 'O',
            'password' => bcrypt('12345678')
        ])->assignRole('Organizador');
        Organizador::create([
            'id' => $user->id
        ]);

       $image = new Image([
            'url' => 'perfil/organizador.jpg',
            'tipo' => 'P'
        ]);
    }
}
