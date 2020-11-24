<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\Apartment;
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $services= [

        'wifi',
        'parking',
        'sauna',
        'sea_view',
        'pool',
        'reception'

      ];

      foreach ($services as $ser) {
        Service::create([
          'service' => $ser
        ]);
      }

      // Service::each(function($serv){
      //   $apart = Apartment::inRandomOrder()
      //           -> take(rand(1,2))
      //           -> get();
      //   $serv -> apartments() -> attach($apart);
      //
      // });

    }
}
