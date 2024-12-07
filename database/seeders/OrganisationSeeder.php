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
            'topic_id' => '0.0.3352476',
            'api_client_id' => env('DH_API_CLIENT_KEY', false),
            'api_client_secret' => env('DH_API_CLIENT_SECRET', false),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('organisations')->insert([
            'id' => 5001,
            'account_id' => 1001,
            'created_by' => 3,
            'name' => 'Fleurieu',
            'email' => 'info@datahash.com.au',
            'topic_id' => '0.0.5193390',
            'api_client_id' => env('FL_API_CLIENT_KEY', false),
            'api_client_secret' => env('FL_API_CLIENT_SECRET', false),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
