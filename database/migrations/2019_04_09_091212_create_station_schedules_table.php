<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id')->unsigned();
            $table->string('day')->nullable();
            $table->date('date')->nullable()->default(null);
            $table->time('open_from')->nullable();
            $table->time('open_till')->nullable();
            $table->time('lunch_start')->nullable();
            $table->time('lunch_end')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->timestamps();

            $table->foreign('station_id')
                ->references('id')->on('stations')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_schedules');
    }
}
