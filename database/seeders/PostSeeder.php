<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Post::create([
            'title' => 'post',
            'body' => 'post from seeder',
            'user_id' => 1,
            'tag_id' => 1,
        ]);
    }
}
