<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_quotations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->nullable();
            $table->string('rfq_ref')->nullable();
            $table->date('receiving_date')->nullable();
            $table->string('category')->nullable();
            $table->string('qtn_ref_no')->nullable();
            $table->string('total_value')->nullable();
            $table->date('devlivery_time')->nullable();
            $table->string('upload_qtn_copy')->nullable();
            $table->string('upload_rfq_copy')->nullable();
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
        Schema::dropIfExists('vendor_quotations');
    }
}
