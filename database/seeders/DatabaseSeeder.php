<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Schema::disableForeignKeyConstraints();
        Animal::truncate();
        User::truncate();
        Type::truncate();
        Type::factory(5)->create();
        User::factory(5)->create();
        Animal::factory(10000)->create();
        Schema::enableForeignKeyConstraints();
    }
}
