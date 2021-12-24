<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEachRfqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('each_rfqs', function (Blueprint $table) {
            $table->id();
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('vendor_rfq_id')->unsigned();
            $table->foreign('vendor_rfq_id')->references('id')->on('vendor_rfqs')->onDelete('cascade');
            
            $table->string('category');
            $table->string('status');
            
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
        Schema::dropIfExists('each_rfqs');
    }
}
