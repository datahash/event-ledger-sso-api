<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organisations')->insert([
            'id' => 5000,
            'account_id' => 1000,
            'created_by' => 1,
            'name' => 'Datahash',
            'email' => 'chris@datahash.com.au',
            'api_client_id' => 'GDHWEVPQEMYSRGFK',
            'api_client_secret' => 'nRQGKLuemSkQzXzV9laUTUGZCe8HyGdO',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('organisations')->insert([
            'id' => 5001,
            'account_id' => 1001,
            'created_by' => 1,
            'name' => 'Fleurieu',
            'email' => 'info@datahash.com.au',
            'api_client_id' => 'ZNBUDFAZRYBXJOTN',
            'api_client_secret' => 'ZTuyCkoMZvQm6Z6vf9UXmoB9E8c1WNof',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
