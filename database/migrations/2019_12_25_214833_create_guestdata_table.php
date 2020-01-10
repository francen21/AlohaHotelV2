<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests_data', function (Blueprint $table) {
            $table->bigIncrements('guest_id');
            $table->string('guest_name', 100);
            $table->string('guest_lastname', 30);
            $table->string('guest_gender', 30);
            $table->string('guest_address', 200);
            $table->string('guest_city', 20);
            $table->string('guest_country', 40);
            $table->string('guest_remarks', 40);
            $table->string('guest_email', 40);
            $table->string('guest_mobile', 20);
            $table->string('guest_type', 100)->nullable();
            $table->string('guest_number', 100)->nullable();
            $table->unsignedBigInteger('guest_checkin_points')->nullable();
            $table->double('guest_balance', 8, 2)->nullable();
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
        Schema::dropIfExists('guests_data');
    }
}
