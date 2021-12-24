<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLpoMgtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lpo_mgts', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->index();
            $table->string('department');
            $table->string('rfm_ref_no');
            $table->string('subject');
            $table->string('site');
            $table->string('value');
            $table->date('date_requested');
            $table->string('requestor');
            $table->string('rfm_copy_link')->nullable();
            $table->string('lpo_copy_link')->nullable();
            $table->string('status')->default('0');
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
        Schema::dropIfExists('lpo_mgts');
    }
}
