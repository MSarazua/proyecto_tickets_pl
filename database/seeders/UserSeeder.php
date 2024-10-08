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
            "password" => bcrypt("12345678"),
            'area_id' => 1
        ])->assignRole("Admin");

        User::create([
            "name" => "Luis Arroyo",
            "email" => "larroyo@gmail.com",
            "password" => bcrypt("12345678"),
            'area_id' => 1
        ])->assignRole("Dev");

        User::factory(9)->create();
    }
}
