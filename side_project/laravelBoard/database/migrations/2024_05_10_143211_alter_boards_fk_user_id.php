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
    {   // 포린키설정할컬럼 -> 참조할 컬럼 -> 참조할 컬럼이 있는 테이블
        Schema::table('boards', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boards', function(Blueprint $table) {
            // 제약조건명으로 제거
            // $table->dropForeign('boards_user_id_foreign');
            // 컬럼명으로 제거
            $table->dropForeign(['user_id']);
        });
    }
};
