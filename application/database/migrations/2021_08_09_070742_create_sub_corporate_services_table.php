<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCorporateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_corporate_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('corporateservice_id')->onDelete('cascade');
            $table->foreign('corporateservice_id')->references('id')->on('corporate_services');
            $table->string('description');
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
        Schema::dropIfExists('sub_corporate_services');
    }
}
