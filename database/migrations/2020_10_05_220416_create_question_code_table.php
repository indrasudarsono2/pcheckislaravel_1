<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_code', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rating_id');
            $table->float('a', 5)->nullable();
            $table->float('b', 5)->nullable();
            $table->float('c', 5)->nullable();
            $table->float('d', 5)->nullable();
            $table->float('e', 5)->nullable();
            $table->float('f', 5)->nullable();
            $table->float('g', 5)->nullable();
            $table->float('h', 5)->nullable();
            $table->float('i', 5)->nullable();
            $table->float('j', 5);
            $table->float('essay', 5)->nullable();
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
        Schema::dropIfExists('question_code');
    }
}
