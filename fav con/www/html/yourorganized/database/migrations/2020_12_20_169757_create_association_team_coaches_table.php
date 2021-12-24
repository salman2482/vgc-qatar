<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationTeamCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association_team_coaches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('association_team_id');
            $table->foreign('association_team_id')
                    ->references('id')
                    ->on('association_teams')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('association_id');
            $table->foreign('association_id')
                    ->references('id')
                    ->on('associations')
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
        Schema::dropIfExists('association_team_coaches');
    }
}
