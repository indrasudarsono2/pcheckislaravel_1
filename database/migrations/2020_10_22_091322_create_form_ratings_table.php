<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplication_file_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rating_id');
            $table->string('control_hours', 10)->nullable();
            $table->foreignId('status_id');
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
        Schema::dropIfExists('form_ratings');
    }
}
