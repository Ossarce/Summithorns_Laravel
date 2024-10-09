<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'username' => 'SummitHorns',
            'email' =>  'summithorns@example.com',
            'is_verified' => 1,
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()
        ]);
    }
}
