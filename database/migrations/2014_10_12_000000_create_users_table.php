<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login',50);
            $table->string('password',200);
            $table->string('email',80);
            $table->datetime('start_date');
            $table->integer('czas_ostatniego_pobytu');
            $table->string('ip_ostatniego_logowania',15);
            $table->string('system_operacyjny',30);
            $table->string('przegladarka',65);
            $table->string('sciezka_style',50);
            $table->string('rodzaj_usera',20);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
