<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineInServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_in_service', function (Blueprint $table) {
            $table->id();
            $table->date('yearmonth');
            $table->string('TR1');
            $table->string('TR2',20)->nullable();
            $table->string('TR3',20)->nullable();
            $table->string('TR4',20)->nullable();
            $table->string('TR5',20)->nullable();
            $table->string('TR6',20)->nullable();
            $table->string('TR7',20)->nullable();
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
        Schema::dropIfExists('line_in_service');
    }
}
