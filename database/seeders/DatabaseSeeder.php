<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'id' => 1,
             'name' => 'Henk',
             'email' => 'henk@roos.org',
         ]);

        DB::table('sets')->insert([
             'id' => 1,
             'name' => 'Frans 1',
             'user_id' => 1,
             'front_descr' => 'Frans',
             'back_descr' => 'Nederlands',
         ]);

        DB::table('sets')->insert([
            'id' => 2,
            'name' => 'Latijn IV',
            'user_id' => 1,
            'front_descr' => 'Latijn',
            'back_descr' => 'Nederlands',
        ]);
    }
}
