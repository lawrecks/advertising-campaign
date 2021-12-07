<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaigns = [];

        array_push($campaigns, [
            'name' => 'Test 1',
            'total_budget' => 1000.00,
            'daily_budget' => 200.00,
            'to_date' => '2021-12-07',
            'from_date' => '2021-12-03',
        ]);
        array_push($campaigns, [
            'name' => 'Test 2',
            'total_budget' => 1000.00,
            'daily_budget' => 200.00,
            'to_date' => '2021-12-07',
            'from_date' => '2021-12-03',
        ]);

        DB::table('campaigns')->insert($campaigns);
    }
}
