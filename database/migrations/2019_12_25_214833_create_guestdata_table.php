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
            $table->string('guest_tittle', 5);
            $table->string('guest_name', 23);
            $table->string('guest_lastname', 20);
            $table->string('guest_gender', 10)->nullable()->default('Others');
            $table->string('guest_address', 150)->default('Undefined');
            $table->string('guest_city', 20)->default('Undefined');
            $table->string('guest_country', 20)->default('Undefined');
            $table->string('guest_email', 30);
            $table->string('guest_mobile', 15)->nullable()->default('Undefined');
            $table->string('guest_type', 40);
            $table->string('guest_number', 80);
            $table->string('guest_remarks', 200)->default('No remarks');
            $table->unsignedBigInteger('guest_checkin_points')->nullable();
            $table->double('guest_balance', 8, 2)->nullable();
            $table->string('alter_name', 23);
            $table->string('alter_lastname', 20);
            $table->string('alter_city', 20)->default('Undefined');
            $table->string('alter_country', 20)->default('Undefined');
            $table->string('howFind', 150)->default('Undefined');
            /**
             * alternative firstname (optional)<
             * alternative lastname (optional)<
             * alternative city<
             * alternative country<
             * howfind<
             */
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
