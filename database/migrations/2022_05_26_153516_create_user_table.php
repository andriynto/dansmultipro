<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
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
            $table->string('uuid', '36');
            $table->string('name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->string('picture')->default('avatar.jpg')->nullable();
            $table->timestamp('last_logged_in_at')->nullable();
            $table->boolean('enabled')->default(1);
            $table->datetime('expired_in')->nullable();
            $table->boolean('verify')->default(0);
            $table->boolean('suspend')->default(1);
            $table->string('locale')->default('id-ID');
            $table->string('last_session')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'deleted_at']);
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
