<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorRfqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_rfqs', function (Blueprint $table) {
            $table->id();
            $table->string('rfq_ref')->nullable();
            $table->string('category')->nullable();
            $table->string('priority')->nullable();
            $table->date('due_date_request')->nullable();
            $table->string('sn')->nullable();
            $table->string('description')->nullable();
            $table->string('uom')->nullable();
            $table->string('qty')->nullable();
            $table->string('required_quotation_validity')->nullable(); 
            $table->string('status')->nullable()->default('WAITING FOR APPROVAL');
            $table->date('receiving_date')->nullable();
            $table->string('requestor')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('vendor_rfqs');
    }
}
