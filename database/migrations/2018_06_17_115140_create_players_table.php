<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('player_id');
            $table->integer('current_team_id')->unsigned();
            $table->string('name');
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('email');
            $table->string('position');
            $table->string('player_status');
            $table->string('sub_team');
            $table->date('date_joined');
            $table->date('date_left');
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
        Schema::dropIfExists('players');
    }
}
