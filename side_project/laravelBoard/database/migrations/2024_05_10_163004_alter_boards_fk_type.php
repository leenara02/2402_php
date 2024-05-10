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
    { // 포린키설정할컬럼 -> 참조할 컬럼 -> 참조할 컬럼이 있는 테이블
        Schema::table('boards', function(Blueprint $table) {
            $table->foreign('type')->references('type')->on('board_names');
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
            $table->dropForeign(['type']);
        });
    }
};
