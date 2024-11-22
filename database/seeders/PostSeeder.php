<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(6, true), // Tiêu đề bài viết
                'abstract' => $faker->paragraph(2, true), // Tóm tắt bài viết
                'content' => $faker->paragraphs(5, true), // Nội dung bài viết
                'thumb' => '/storage/uploads/2024/10/11/29.jpg',
                'author' => $faker->name, // Tên tác giả
                'active' => 1, 
                'post_category_id' => $faker->numberBetween(1, 2), // Giả sử bạn có 10 categories
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
