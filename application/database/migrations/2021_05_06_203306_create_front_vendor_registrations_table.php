<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontVendorRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_vendor_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('vendor_company_name')->nullable();
            $table->string('commercial_registration_no')->nullable();
            $table->string('trade_license_no')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('office_telephone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('po_box')->nullable();
            $table->text('category')->nullable();
            $table->string('company_association')->nullable();
            $table->string('learn_about_compnay')->nullable();
            $table->string('cv_path')->nullable();
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
        Schema::dropIfExists('front_vendor_registrations');
    }
}
