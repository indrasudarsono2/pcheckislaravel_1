<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('place_of_birth', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address_user', 100)->nullable();
            $table->string('nationality', 20)->nullable();
            $table->string('english_confirm', 10)->nullable();
            $table->string('height', 5)->nullable();
            $table->string('weight', 5)->nullable();
            $table->string('hair', 20)->nullable();
            $table->string('eyes', 20)->nullable();
            $table->foreignId('gender_id')->nullable();

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
        Schema::dropIfExists('biodata');
    }
}
