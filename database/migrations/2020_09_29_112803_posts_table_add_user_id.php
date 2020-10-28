<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostsTableAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id'); //สร้างฟิลด์ที่มีความสัมพันธ์ของ user กับ posts สร้างที่ table post

            $table->foreign('user_id')
                ->references('id')
                ->on('users'); //สร้างความสัมพันธ์ ตั้งให้ userid เป็น foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints(); //ตัดความสัพพันธ์ของ forign key เวลาจะลบ
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            Schema::enableForeignKeyConstraints();
        });
    }
}
