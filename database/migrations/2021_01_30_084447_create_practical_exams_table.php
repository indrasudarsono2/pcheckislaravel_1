<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practical_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_rating_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float('score', 5)->nullable();
            $table->foreignId('checker_gain_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('group_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('group_member_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('checker_id')->nullable();
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
        Schema::dropIfExists('practical_exams');
    }
}
