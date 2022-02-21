<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_datas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplication_file_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('verification_item_id');
            $table->foreignId('checker_id');
            $table->string('status', 10);
            $table->string('match', 10);
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('verification_datas');
    }
}
