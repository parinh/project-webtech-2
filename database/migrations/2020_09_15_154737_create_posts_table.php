<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration //สร้างด้วยคำสั่ง php artisan make:migration create_posts_table --create=posts
{ //ดูใน laravel/migration
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) { //การสร้าง table ข้อมูลให้ DB
            $table->id(); //ข้อมูลใน table ของ database
            $table->string('topic')->nullable(false); //หัวข้อตั้งชื่อฟิลด์->ห้ามว่าง
            $table->text('content');//เนื้อหาว่างได้
            $table->integer('view_count')->default(0);//จำนวน view เริ่มที่ 0
            $table->timestamps();
            $table->softDeletes('deleted_at');//การลบที่ยังอยู่บน DB
        });
        //แล้วก็ใช้คำสั่ง  php artisan migrate เพื่อสร้างตารางของ DB
        //ต้องสร้าง model เพื่อให้มันเอาข้อมูลใส่ในตารางได้ ใช้คำสั่ง php artisan make:model Post สร้างเสร็จจะไปอยู่หน้า model
        //เวลาใส่ค่าใน DB ใช้คำสั่ง php artisan tinker แล้วก็สร้าง object มา new path ของไฟล์ post พอเสร็จก็ save
        // $post = new \App\Models\Post;
        // $post->topic = "Post Topic 1"; ทำจนครบทุกฟิลด์ แล้วก็ $post->save() มันก็จะขึ้นใน DB ไปดูใน DB ขวามือ
        // $post = \App\Models\Post::get() ดูข้อมูลทั้งหมด
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
