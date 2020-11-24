<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('description',150);
            $table->integer('number_of_rooms');
            $table->integer('number_of_beds');
            $table->integer('number_of_bathrooms');
            $table->integer('square_meters');
            $table->string('address',80);
            $table->string('city',60);
            $table->string('state',60);
            $table->string('lat')->default('12.1000');
            $table->string('lng')->default('12.1000');
            $table->timestamp('date_of_creation');
            $table->boolean('sponsorship')->default(false);
            $table->boolean('visibility')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
