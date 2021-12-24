<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_pos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('po_ref')->nullable();
            $table->string('issuing_date')->nullable();
            $table->string('qtn_ref_no')->nullable();
            $table->string('category')->nullable();
            $table->string('total_value')->nullable();
            $table->text('terms_condition')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('upload_qtn_copy')->nullable();
            $table->string('upload_po_copy')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('vendor_pos');
    }
}
