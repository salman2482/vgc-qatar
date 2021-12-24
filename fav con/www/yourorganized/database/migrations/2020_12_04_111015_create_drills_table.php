<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('mins')->nullable();                   
            $table->integer('surface')
                    ->default(1);
                    //->comment('1 -active, 0 - inactive');
            $table->longText('sketchpad_data')->nullable();        
           
            $table->longText('age_group')->nullable(); 
            $table->longText('tags')->nullable();             
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
           
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
        Schema::dropIfExists('drills');
    }
}
