<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_data', function (Blueprint $table) {
            $table->bigIncrements('reservation_id');
            $table->unsignedBigInteger('room_number');
            $table->unsignedBigInteger('guest_id');
            $table->unsignedSmallInteger('guest_cap');
            $table->string('discount_type', 15);
            $table->time('grace_time', 0);
            $table->string('purpose_visit', 25);
            $table->string('from', 20);
            $table->string('to', 20);
            $table->tinyInteger('number_persons');
            $table->tinyInteger('male_');
            $table->tinyInteger('female_');
            $table->tinyInteger('children_');
            $table->date('check_in');
            $table->date('check_out');
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
        Schema::dropIfExists('reservations_data');
    }
}
