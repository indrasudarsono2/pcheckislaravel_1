<?php

use App\Aplication_file;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_confirms', function (Blueprint $table) {
            $table->id();
            $table->string('confirm', 10)->nullable();
            $table->foreignId('aplication_file_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('remark', 20)->nullable();
            $table->string('rating_id', 20)->nullable();
            $table->string('location')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('rating_confirms');
    }
}
