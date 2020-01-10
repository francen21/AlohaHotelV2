<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_data', function (Blueprint $table) {
            $table->bigIncrements('room_id');
            $table->string('room_floor', 20);
            $table->string('room_floor', 20);
            $table->string('room_type', 20);
            $table->string('room_status', 20);
            $table->double('room_tarrif', 8, 2);
            $table->unsignedinteger('room_number');
            $table->unsignedinteger('room')->default('');
            $table->unsignedinteger('room_sales')->nullable();
            $table->unsignedinteger('room_views')->nullable();
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
        Schema::dropIfExists('rooms_data');
    }
}
