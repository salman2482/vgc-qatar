<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->string('client_rfq_ref');
            $table->unsignedBigInteger('client_id');
            $table->date('issuance_date');
            $table->date('expiration');
            $table->date('delivery_date');
            $table->string('estimated_by');
            $table->string('delivered_by');
            $table->string('delivery_method');
            $table->string('transmittal_copy')->nullable();
            $table->string('financial_copy')->nullable();
            $table->string('technical_copy')->nullable();
            $table->string('status')->default('submitted');
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
        Schema::dropIfExists('quotations');
    }
}
