<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        \App\Models\Setting::create([
            'key' => 'phone',
            'value' => '+374 98 00 00 00',
        ]);

        // \App\Models\Tag::factory()->create([
        //     'phone' => '+374 98 00 00 00',
        //     'email' => 'test@gmail.com',
        //     'address' => 'test address',
            
        // ]);
    }
}
