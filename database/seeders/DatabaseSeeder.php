<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'credits' => 5,
             'dob' => 'dob',
             'firstName' => 'test',
             'lastName' => 'user',
             'phone' => '5555555555',
             'address1' => 'address1',
             'address2' => 'address2',
             'city' => 'los angeles',
             'state' => 'ca',
             'zip' => '90210',
             'email' => 'testuser@moosecodes.com',
         ]);
    }
}
