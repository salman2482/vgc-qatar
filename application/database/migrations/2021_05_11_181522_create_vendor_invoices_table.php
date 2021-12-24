<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('lpo_ref')->nullable();
            $table->string('qtn_ref')->nullable();//optional dont reuqire it or add it in the form
            $table->string('category')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('invoice_ref_no')->nullable();
            $table->string('total_value')->nullable();
            $table->string('upload_lpo_copy')->nullable();
            $table->string('upload_qtn_copy')->nullable();
            $table->string('upload_invoice_copy')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('vendor_invoices');
    }
}
