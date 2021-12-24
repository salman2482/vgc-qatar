<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('sports');
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->longText('address')->nullable();
            $table->date('season_start');
            $table->date('season_end')->nullable();

            $table->integer('status')
            ->default(1)
            ->comment('1 -active, 0 - inactive');  
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
        Schema::dropIfExists('associations');
    }
}
