<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentManagmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_managments', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->date('issue_date');
            $table->string('category');
            $table->string('subject');
            $table->string('delivered_by');
            $table->string('delivery_method');
            $table->string('remarks');
            $table->date('delivery_date');
            $table->date('expiration');
            $table->string('submital_copy')->nullable();
            $table->string('document_copy')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('document_managments');
    }
}
