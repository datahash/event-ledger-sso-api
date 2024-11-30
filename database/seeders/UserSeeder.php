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
            'id' => 1,
            'name' => 'domingobishop@gmail.com',
            'email' => 'domingobishop@gmail.com',
            'password' => '41Pe2sMZPN1BFq2s',
            'account_id' => '1000',
            'organisation_id' => '5000',
            'user_role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'chris@datahash.com.au',
            'email' => 'chris@datahash.com.au',
            'password' => '41Pe2sMZPN1BFq2s',
            'account_id' => '1000',
            'organisation_id' => '5000',
            'user_role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'info@datahash.com.au',
            'email' => 'info@datahash.com.au',
            'password' => '41Pe2sMZPN1BFq2s',
            'account_id' => '1001',
            'organisation_id' => '5001',
            'user_role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
