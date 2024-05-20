<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('account', 20)->unique();
            $table->string('password');
            $table->char('gender', 1)->comment('0:M, 1:F');
            $table->string('profile', 100)->nullable();
            $table->string('refresh_token', 512)->nullable(); // null이면 로그인안되어있는유저
            $table->timestamps();
            $table->softDeletes();
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
};
