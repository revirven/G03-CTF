<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 50);
            $table->string('descript', 200);
            $table->string('hint', 200)->nullable();
            $table->string('file', 50)->nullable();
            $table->enum('category', ['web', 'pwn', 'rev', 'frs']);
            $table->bigInteger('score');
            $table->string('flag', 255);
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
        Schema::dropIfExists('challenges');
    }
}
