<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            [
                'title' => 'Black Friday',
                'value' => 30.0,
                'campaign_id' => 1,
                'product_id' => 1
            ],
            [
                'title' => 'Natal',
                'value' => 15.3,
                'campaign_id' => 1,
                'product_id' => 2
            ],
            [
                'title' => 'Natal',
                'value' => 15.3,
                'campaign_id' => 1,
                'product_id' => 3
            ],
            [
                'title' => 'Cyber Week',
                'value' => 60,
                'campaign_id' => 1,
                'product_id' => 4
            ],
            [
                'title' => 'Black Friday',
                'value' => 30.0,
                'campaign_id' => 2,
                'product_id' => 1
            ],
            [
                'title' => 'Natal',
                'value' => 15.3,
                'campaign_id' => 2,
                'product_id' => 2
            ],
            [
                'title' => 'Natal',
                'value' => 15.3,
                'campaign_id' => 2,
                'product_id' => 3
            ],
            [
                'title' => 'Cyber Week',
                'value' => 60,
                'campaign_id' => 2,
                'product_id' => 6
            ],
            
        ]);
    }
}
