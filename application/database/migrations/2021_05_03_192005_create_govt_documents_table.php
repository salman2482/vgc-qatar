<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovtDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('govt_documents', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_document');
            $table->integer('doc_no');
            $table->date('issue_date');
            $table->date('validity_date');
            $table->string('renewal_cost');
            $table->string('last_renewal_by');
            $table->string('document_copy');
            $table->string('last_renewal_copy');
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
        Schema::dropIfExists('govt_documents');
    }
}
