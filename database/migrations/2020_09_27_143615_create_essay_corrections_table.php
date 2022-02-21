<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEssayCorrectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay_corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('score_id');
            $table->foreignId('form_rating_id');
            $table->foreignId('essay_id');
            $table->text('essay_answer')->nullable();
            $table->float('essay_score', 5);
            $table->foreignId('checker_id');
            $table->foreignId('remark_essay_id');
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
        Schema::dropIfExists('essay_corrections');
    }
}
