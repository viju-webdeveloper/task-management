<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // uncomment the line below to create 10 random users, tasks, and categories 
        //Task::factory(10)->create();

        // Create 5 categories
        Category::create(['name' => 'Work', 'description' => 'Tasks related to your job or profession.']);
        Category::create(['name' => 'Personal', 'description' => 'Personal errands and activities.']);
        Category::create(['name' => 'Shopping', 'description' => 'Items to buy or shopping lists.']);
        Category::create(['name' => 'Fitness', 'description' => 'Exercise and health-related tasks.']);
        Category::create(['name' => 'Learning', 'description' => 'Tasks for study or skill development.']);
    }
}
