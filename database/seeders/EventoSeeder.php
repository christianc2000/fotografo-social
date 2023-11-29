<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Organizador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('eventos')->insert([
            [
                'title' => 'Evento 1',
                'description' => 'Descripción del evento 1',
                'address' => 'Dirección 1',
                'gps' => 'GPS 1',
                'event_date' => '2023-12-01',
                'organizador_id' => Organizador::first()->id,
                'status' => Evento::$STATUS_FINISH,
                'img_event' => 'https://th.bing.com/th/id/R.157f804611abbfe1bd7dda578d9e81ef?rik=%2bhmvY%2bIc5mkyGw&pid=ImgRaw&r=0'
            ],
            [
                'title' => 'Evento 2',
                'description' => 'Descripción del evento 2',
                'address' => 'Dirección 2',
                'gps' => 'GPS 2',
                'event_date' => '2023-12-02',
                'organizador_id' =>Organizador::first()->id,
                'status' => Evento::$STATUS_FINISH,
                'img_event' => 'https://th.bing.com/th/id/OIP.p-kggGp3m-J9w1_gqZ98xQHaFj?rs=1&pid=ImgDetMain'
            ],
            [
                'title' => 'Evento 3',
                'description' => 'Descripción del evento 2',
                'address' => 'Dirección 2',
                'gps' => 'GPS 2',
                'event_date' => '2023-12-02',
                'organizador_id' =>Organizador::first()->id,
                'status' => Evento::$STATUS_FINISH,
                'img_event' => 'https://th.bing.com/th/id/OIP.FBCjHnBztHY8OJxSi5wq5QEXDf?rs=1&pid=ImgDetMain'
            ],
            // ... Agrega aquí los otros 8 registros ...
        ]);
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
