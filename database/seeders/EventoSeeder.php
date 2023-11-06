<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Organizador;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //gps (lat,long)
        // Evento::create([
        //     'title' => 'ALMUERZO BENÉFICO HOGARES DEL SUR',
        //     'description' => 'Evento benéfico para recaudar fondos de apoyo a los hogares infantiles del Sur',
        //     'address' => 'Plaza Blackut, calle Juan de Garay',
        //     'gps' => '-17.79613, -63.18051',
        //     'event_date' => '2023-09-01 12:00:00',
        //     'img_event'=>'https://i.pinimg.com/originals/66/ad/69/66ad69725aa037d059d292a3c5a522ab.jpg',
        //     'organizador_id' => Organizador::first()->id,
        //     'status' => Evento::$STATUS_ACTIVE
        // ]);
        Evento::create([
            'title' => 'MARATON DE FIN DE MES',
            'description' => 'Evento que incentivará al deporte, organizado por la HAM',
            'address' => 'Plaza Blackut, calle Juan de Garay',
            'gps' => '-17.79613, -63.18051',
            'event_date' => '2023-07-01 08:00:00',
            'img_event'=>'https://i.dailymail.co.uk/i/pix/2014/09/07/1410089535886_wps_17_Mo_Farah_front_centre_at_.jpg',
            'organizador_id' => Organizador::first()->id,
            'status' => Evento::$STATUS_FINISH
        ]);
        Evento::create([
            'title' => 'GRADUACIÓN CARRERA DE ING. INFORMATICA',
            'description' => 'Graduación nivel licenciatura en Ing. Informática, UAGRM 2024',
            'address' => 'Plaza Blackut, calle Juan de Garay',
            'gps' => '-17.79613, -63.18051',
            'event_date' => '2024-07-01 12:00:00',
            'img_event'=>'https://absbuzz.com/wp-content/uploads/2021/02/undergrad.png',
            'organizador_id' => Organizador::first()->id,
            'status' => Evento::$STATUS_ACTIVE
        ]);
    }
}
