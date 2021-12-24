<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfms', function (Blueprint $table) {
            $table->id();
            $table->string('ref_num');
            $table->string('department');
            $table->string('inline_manager_id');
            $table->string('hoc_id')->nullable();
            $table->string('material_id');
            $table->string('subject');
            $table->string('site');
            $table->integer('quantity');
            $table->integer('available_stock');
            $table->date('due_date');
            $table->string('requestor')->nullable();
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
        Schema::dropIfExists('rfms');
    }
}
