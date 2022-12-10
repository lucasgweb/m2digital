<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('campaigns')->insert([
            [
                'name' => 'Campanha 1',
                'group_id' => 1
            ],
            [
                'name' => 'Campanha 2',
                'group_id' => 1
            ],
            [
                'name' => 'Campanha 3',
                'group_id' => 1
            ],
            [
                'name' => 'Campanha 4',
                'group_id' => 2
            ],
            [
                'name' => 'Campanha 5',
                'group_id' => 2
            ],
            [
                'name' => 'Campanha 6',
                'group_id' => 2
            ],
        ]);
    }
}
