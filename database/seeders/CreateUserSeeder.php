<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'users_name' => 'Admin1',
            'rank' => 'admin',
            'password' => Hash::make('a123456789'),
        ]);
        DB::table('users')->insert([
            'users_name' => 'Teacher1',
            'rank' => 'teacher',
            'password' => Hash::make('t123456789'),
        ]);
    }
}
