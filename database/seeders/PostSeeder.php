<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //เอาไว้เทสข้อมูลเวลามีข้อมูลเยอะๆ แล้วเว็บหย้าตาเป็นไง
    {
        $post = new Post;
        $post->topic = 'Hello world';
        $post->content = 'This is first post';
        $post->user_id = 1;
        $post->save();

        $post = new Post;
        $post->topic = 'Hello Imposter';
        $post->content = 'This is second post';
        $post->user_id = 2;
        $post->save();



    }
}
