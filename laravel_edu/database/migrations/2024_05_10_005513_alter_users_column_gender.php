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
    public function up() // migrate하면 이것만 실행된다.
    {
        Schema::table('users', function(Blueprint $table) {
            $table->char('gender', 1)->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // 얘는 롤백할때 실행되는아이.
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
};
