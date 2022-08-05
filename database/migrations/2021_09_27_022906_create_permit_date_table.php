<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_date', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permit_id');
            $table->date('date');
            $table->time('start_at');
            $table->time('end_at');
            $table->timestamps();

            $table->foreign('permit_id')->references('id')->on('permit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permit_date');
    }
}
