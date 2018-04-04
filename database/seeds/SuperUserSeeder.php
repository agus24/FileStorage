<?php

use App\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "email" => "agusx244@gmail.com",
            "password" => bcrypt('rahasia'),
            "name" => "Gustiawan"
        ])->assignRole('superuser');
    }
}
