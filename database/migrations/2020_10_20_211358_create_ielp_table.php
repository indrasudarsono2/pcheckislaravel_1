<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ielp', function (Blueprint $table) {
            $table->id();
            $table->string('confirm', 10)->nullable();
            $table->foreignId('user_id');
            $table->string('rater', 50)->nullable();
            $table->string('institution', 100)->nullable();
            $table->date('released');
            $table->date('expired');
            $table->string('level', 5)->nullable();
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
        Schema::dropIfExists('ielp');
    }
}
