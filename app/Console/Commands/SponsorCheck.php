<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SponsorCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sponsorCheck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the sponsorship has expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $apartment = DB::table('apartments')
                   -> select('id')
                   -> where('sponsorship', '=', true)
                   -> get();

      $sponsorsDead = DB::table('payments')
                     -> select('deadline')
                     -> join('apartments', 'apartments.id', '=', 'payments.apartment_id')
                     -> where('apartments.sponsorship', '=', true)
                     -> get();

      $presentDate = Carbon::now();

      foreach ($sponsorsDead as $sponsorDead) {

        if ($presentDate > $sponsorDead) {

          $apartExpire = DB::table('apartments') -> update(['sponsorship' => false]);
        }
      }
    }
}
