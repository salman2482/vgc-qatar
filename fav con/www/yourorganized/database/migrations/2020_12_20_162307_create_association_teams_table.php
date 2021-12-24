<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_teams', function (Blueprint $table) {
            $table->id();
            $table->string('skill_level');
            $table->string('age_level');
            $table->string('from_year');
            $table->string('to_year');
            $table->unsignedBigInteger('association_id');
            $table->foreign('association_id')
                    ->references('id')
                    ->on('associations')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->integer('status')
            ->default(0)
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
        Schema::dropIfExists('association_teams');
    }
}
