<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory //ใช้คำสั่ง php artisan make:factory PostFactory --model=Post
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class; //ผูกชื่อโมเดลไว้ว่าชื่ออะไร

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ //จุดสร้างข้อมูลพื้นฐานให้ ข้อมูลจะสุ่มให้ได้ faker
            'topic' => $this->faker->realText(100), //สุ่ม data มา
            'content' => $this->faker->realText(350),
            'view_count'=> $this->faker->numberBetween(0,10000)

            //เอาไปผูกกะโมเดล ที่ชื่อ post แล้วดังนั้น post สามารถเรียก factory ได้เลย
            //\App\Models\Post::factory()->make() คำสังไปลองใน comman แต่ข้อมูลยังไม่ลง db นะ
            //\App\Models\Post::factory()->count(5)->create() สร้างข้อมูลลง db หลายๆตัวด้วย
        ];
    }
}
