<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('apartments', function (Blueprint $table) {
        $table -> foreign('user_id', 'ap-us')
               -> references('id')
               -> on('users');
      });

      Schema::table('messages', function (Blueprint $table) {
        $table -> foreign('apartment_id', 'me-ap')
               -> references('id')
               -> on('apartments');
      });

      Schema::table('statistics', function (Blueprint $table) {
        $table -> foreign('apartment_id', 'st-ap')
               -> references('id')
               -> on('apartments');
      });


      Schema::table('apartment_service', function (Blueprint $table) {
          $table -> foreign('apartment_id', 'ap-se-ap')
                 -> references('id')
                 -> on('apartments')
                 -> onDelete('cascade');

          $table -> foreign('service_id', 'ap-se-se')
                 -> references('id')
                 -> on('services');
      });
      Schema::table('payments', function (Blueprint $table) {
          $table -> foreign('apartment_id', 'pa-ap')
                 -> references('id')
                 -> on('apartments')
                 -> onDelete('cascade');

          $table -> foreign('sponsorship_id', 'pa-sp')
                 -> references('id')
                 -> on('sponsorships');
      });

      Schema::table('images', function (Blueprint $table) {
        $table -> foreign('apartment_id', 'ap-im')
               -> references('id')
               -> on('apartments')
               -> onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('apartments', function (Blueprint $table) {
        $table -> dropForeign('ap-us');
      });
      Schema::table('messages', function (Blueprint $table) {
        $table -> dropForeign('me-ap');
      });
      Schema::table('statistics', function (Blueprint $table) {
        $table -> dropForeign('st-ap');
      });

      Schema::table('apartment_service', function (Blueprint $table) {
        $table -> dropForeign('ap-se-ap');
        $table -> dropForeign('ap-se-se');
      });
      Schema::table('payments', function (Blueprint $table) {
        $table -> dropForeign('pa-ap');
        $table -> dropForeign('pa-sp');
      });

      Schema::table('images', function (Blueprint $table) {
        $table -> dropForeign('ap-im');
      });
    }
}
