<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('web')->default(0);
            $table->unsignedBigInteger('pwn')->default(0);
            $table->unsignedBigInteger('rev')->default(0);
            $table->unsignedBigInteger('frs')->default(0);
            $table->unsignedBigInteger('total')->virtualAs('web + pwn + rev + frs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
