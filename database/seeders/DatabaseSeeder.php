<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $Frontend = Category::factory()->create(['name'=>'Frontend']);
        $Backend = Category::factory()->create(['name'=>'Backend']);
        $Javascript = Category::factory()->create(['name'=>'Javascript']);
        Blog::factory(5)
                ->has(Comment::factory()->count(3))
                ->create(['category_id'=>$Frontend->id]);
        Blog::factory(5)
                ->has(Comment::factory()->count(3))
                ->create(['category_id'=>$Backend->id]); 
        Blog::factory(5)
                ->has(Comment::factory()->count(3))
                ->create(['category_id'=>$Javascript->id]); 
    }
    
}
