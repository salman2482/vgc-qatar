<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractMgtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_mgts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('ref_no');
            $table->date('issuance_date');
            $table->string('category'); // added
            $table->string('description');
            $table->string('signed_by');
            $table->date('sarting_date');
            $table->date('expiray_date');
            $table->date('renewal_date');
            $table->string('project_value');
            $table->string('remarks');
            $table->string('lpo_copy')->nullable();
            $table->string('contract_copy')->nullable();
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
        Schema::dropIfExists('contract_mgts');
    }
}
