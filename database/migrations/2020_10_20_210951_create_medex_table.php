<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medex', function (Blueprint $table) {
            $table->id();
            $table->string('confirm', 10)->nullable();
            $table->foreignId('user_id');
            $table->date('released');
            $table->date('expired');
            $table->string('examiner', 50)->nullable();
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
        Schema::dropIfExists('medex');
    }
}
