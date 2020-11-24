<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use App\Service;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Apartment::class, 4)
      -> make()
      -> each(function($apart){
        $user = User::inRandomOrder() -> first();
        $apart -> user() -> associate($user);
        $apart -> save();
      });

      Apartment::each(function($apar){
        $ser = Service::inRandomOrder()
                -> take(rand(0,6))
                -> get();
        $apar -> services() -> attach($ser);

      });

    }
}
