<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplication_files', function (Blueprint $table) {
            $table->id();
            $table->string('number', 50)->nullable();
            $table->foreignId('remark_ap_file_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('session_id');
            $table->foreignId('status_id');
            $table->timestamp('provision_date')->nullable();
            $table->foreignId('activity_id');
            $table->foreignId('medex_id');
            $table->foreignId('ielp_id');
            $table->foreignId('control_id')->nullable();
            $table->string('ats_name', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('drugs', 10)->nullable();
            $table->string('failed', 10)->nullable();
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
        Schema::dropIfExists('aplication_files');
    }
}
