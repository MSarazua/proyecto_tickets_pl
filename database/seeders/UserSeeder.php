<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "María Sarazúa",
            "email" => "sarazuamaria@gmail.com",
            "password" => bcrypt("12345678")
        ])->assignRole("Admin");

        User::factory(9)->create();
    }
}
