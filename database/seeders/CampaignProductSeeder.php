<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaign_product')->insert([
            [
                'campaign_id' => 1,
                'product_id' => 1
            ],
            [
                'campaign_id' => 1,
                'product_id' => 2
            ],
            [
                'campaign_id' => 1,
                'product_id' => 3
            ],
            [
                'campaign_id' => 1,
                'product_id' => 4
            ],
            [
                'campaign_id' => 1,
                'product_id' => 5
            ],
            [
                'campaign_id' => 1,
                'product_id' => 6
            ],
            [
                'campaign_id' => 2,
                'product_id' => 1
            ],
            [
                'campaign_id' => 2,
                'product_id' => 2
            ],
            [
                'campaign_id' => 2,
                'product_id' => 3
            ],
            [
                'campaign_id' => 2,
                'product_id' => 4
            ],
            [
                'campaign_id' => 2,
                'product_id' => 5
            ],
            [
                'campaign_id' => 2,
                'product_id' => 6
            ],
            
        ]);
    }
}
