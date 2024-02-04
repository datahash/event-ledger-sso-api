<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'domingobishop@gmail.com',
            'email' => 'domingobishop@gmail.com',
            'password' => 'NsMZPq2s1BF41Pe2',
            'account_id' => '1',
            'organisation_id' => '1',
            'user_role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'chris@datahash.com.au',
            'email' => 'chris@datahash.com.au',
            'password' => 'NsMZPq2s1BF41Pe2',
            'account_id' => '1',
            'organisation_id' => '1',
            'user_role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
